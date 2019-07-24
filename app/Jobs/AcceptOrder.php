<?php

namespace App\Jobs;

use App\Order;
use EasyPost\EasyPost;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;

use App\InternalError;
use EasyPost\Error;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use App\Product;

class AcceptOrder implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $shopifyConfig;
    public $configEasyPost;
    public $request;
    public $send_to_easypost = false;

    public function __construct($shopifyConfig, $configEasyPost,$request) {
        //

        $this->shopifyConfig = $shopifyConfig;
        $this->configEasyPost = $configEasyPost;
        $this->request = $request;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        //

       return $this->createFulfillmentOrder();
    }

    public function createFulfillmentOrder() {

        $order = Order::where('shopify_id', $this->request['id'])->first();

        $this->send_to_easypost = false;
        //Check if order not exist in our system
        logger('hahha2');
        if (!$order) {
            logger('here');
            EasyPost::setApiKey($this->configEasyPost['API_KEY']);

            $easyPostOrderFulfillment['service'] = 'standard';
            $easyPostOrderFulfillment['destination'] = [
                'name'        => $this->request['shipping_address']['name'],
                "street1"     => $this->request['shipping_address']['address1'],
                "city"        => $this->request['shipping_address']['city'],
                "state"       => $this->request['shipping_address']['province_code'],
                "zip"         => $this->request['shipping_address']['zip'],
                "country"         => $this->request['shipping_address']['country_code'],
                "residential" => true
            ];
            logger($this->request['line_items']);
            $itemsCount = 0;
            foreach ($this->request['line_items'] as $item) {


                $itemsCount += $item['quantity'];
                $easyPostOrderFulfillment['line_items'][] = [
                    "product" => ["barcode" => $item['sku']],
                    "units"   => $item['quantity']
                ];
            }
           if ($itemsCount <= 3) {

               $additionalProduct = $this->getProduct(1089709637668);
               $easyPostOrderFulfillment['line_items'][] = [
                   //This is for production
                   //"product" => ["barcode" => $item['sku']],
                   //This is for test orders
                   "product" => ["barcode" => isset($additionalProduct['variants'][0]['barcode']) && $additionalProduct['variants'][0]['barcode'] ? $additionalProduct['variants'][0]['barcode'] : $additionalProduct['variants'][0]['sku']],
                   "units"   => 1
               ];
           }


            $client = new Client();

            try {

                $res = $client->post('https://api.easypost.com/fulfillment/vendor/v2/orders', [
                    'headers' => ['Content-type' => 'application/json'],
                    'auth'    => [
                        'tLxVX2kdaW3sbGnq80eUSg',
                        null
                    ],
                    'json'    => $easyPostOrderFulfillment
                ]);
                $resBody = json_decode($res->getBody(), 1);
                logger('start fulfillment');
                logger($resBody);
                logger('end fulfillment');
                $this->createOrder($resBody['id']);
                return response()->json(['success' => 'success'], 200);
            } catch (ClientException $exception) {
                logger($exception);
                return response()->json(['success' => 'success'], 200);
            }
            return response()->json(['success' => 'success'], 200);
        }
    }

    public function getProduct($id = 1089709637668) {

        $shopify = new \PHPShopify\ShopifySDK($this->shopifyConfig);
        return $shopify->Product($id)->get();

    }

    public function createOrder($easypost_order_id) {

        EasyPost::setApiKey($this->configEasyPost['API_KEY']);

        $addresses['to_address'] = [
            "name"    => $this->request['shipping_address']['name'],
            "street1" => $this->request['shipping_address']['address1'],
            "city"    => $this->request['shipping_address']['city'],
            "state"   => $this->request['shipping_address']['province_code'],
            "zip"     => $this->request['shipping_address']['zip'],
            "phone"   => $this->request['shipping_address']['phone']
        ];

        /*
         * TODO to ask what is his from address
         */
        $addresses['from_address'] = [
            "company" => "EasyPost",
            "street1" => "118 2nd Street",
            "street2" => "4th Floor",
            "city"    => "San Francisco",
            "state"   => "CA",
            "zip"     => "94105",
            "phone"   => "415-456-7890"
        ];
        $to_address = \EasyPost\Address::create($addresses['to_address']);


        //From Address will be only one
        $from_address = \EasyPost\Address::create($addresses['from_address']);

        $weight_in_oz = $this->request['total_weight'] * 0.035;
        //Check if total weight is <= 0
        // EasyPost don't accept 0 as weight

        if ($this->request['total_weight'] <= 0) {
            $weight_in_oz = 0.1;
        }


        logger($weight_in_oz);

//            $weight_in_oz = 0;


        try {
            logger('start order');

            $parcel = \EasyPost\Parcel::create(array(
                "predefined_package" => "LargeFlatRateBox",
                "weight"             => $weight_in_oz
                //this is in oz.
            ));


            $shipment = \EasyPost\Shipment::create(array(
                "to_address"   => $to_address,
                "from_address" => $from_address,
                "parcel"       => $parcel
            ));

            $shipment->buy($shipment->lowest_rate());

            $this->send_to_easypost = true;
            //                $shipment->insure(array('amount' => 100));
            logger('end order');

        } catch (Error $error) {
//                FailedOrders()
            logger('not Sended');

            $message['order_number'] = $this->request['number'];
            $message['error_code'] = $error->getHttpStatus();
            $message['error_message'] = $error->getMessage();


            //Log errors in DB
            InternalError::create([
                'shopify_order_number' => $this->request['number'],
                'error_body'           => json_encode($error)
            ]);
//                FailedOrders::dispatch($message, $addresses, $this->configEasyPost['API_KEY'], $weight_in_oz)->delay(now()->addMinutes(5));
            FailedOrders::dispatch($message, $addresses, $this->configEasyPost['API_KEY'], $weight_in_oz, $this->request['number']);

        }

        /*
         * TODO If order is successfyly sent to EasyPost
         * send_to_easypost field should to be updated too
         */

        Order::create([
            'shopify_id'               => $this->request['id'],
            'shopify_email'            => $this->request['email'],
            'shopify_phone'            => $this->request['phone'],
            'shopify_total_price'      => $this->request['total_price'],
            'shopify_order_number'     => $this->request['number'],
            'shopify_total_weight'     => $this->request['total_weight'],
            'shopify_line_items'       => json_encode($this->request['line_items']),
            'shopify_shipping_address' => json_encode($this->request['shipping_address']),
            'shopify_billing_address'  => json_encode($this->request['billing_address']),
            'send_to_easypost'         => $this->send_to_easypost,
            /*
             * TODO Must delete order_weight
             */
            'shopify_order_weight'     => $this->request['total_weight'],
            'shopify_all_order'        => json_encode($this->request),
            'easypost_to_address'      => $to_address,
            'easypost_from_address'    => $from_address,
            'predefined_package'       => 'LargeFlatRateBox',
            'easypost_parcel_weight'   => $weight_in_oz,
            'easypost_order_id'        => $easypost_order_id

        ]);
        return response()->json(['success' => 'success'], 200);
    }

}
