<?php

namespace App\Http\Controllers;

use App\Jobs\AcceptOrder;
use App\Jobs\FailedOrders;
use App\Product;
use Carbon\Carbon;
use EasyPost\EasyPost;
use App\InternalError;
use EasyPost\Error;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Storage;
use App\Order;
use Mail;

class ApiController extends Controller {
    public $config;
    public $configEasyPost;
    public $send_to_easypost = false;


    function __construct() {
        $this->config = array(
            'ShopUrl'      => 'tradlands-app.myshopify.com',
            'ApiKey'       => 'ac2c96071db4f676e4e7f547fd5e5a29',
            'Password'     => '44d9ccea22e5acbf49db8cbcb2e7c79a',
            'SharedSecret' => 'f7725528c756f5340146b9f2afcf503e'
        );
        //    $this->config = array(
        //        'ShopUrl'      => 'https://tradlands.myshopify.com',
        //        'ApiKey'       => 'f1caf89d0c39b9b515ee2e136a2147d4',
        //        //            'ApiKey'       => '24ffd496be17e6ea65064a8bf7b2e55e',
        //        //f1caf89d0c39b9b515ee2e136a2147d4 - APIKey
        //        'Password'     => 'b79dc9ab3df62bcd17bc05d063b90e8c',
        //        //            'Password'     => 'a78ab8a1ffe51cfb2fbcee11809f433d',
        //        //b79dc9ab3df62bcd17bc05d063b90e8c - APIPass
        //        'SharedSecret' => 'f7725528c756f5340146b9f2afcf503e'
        //    );
        $this->configEasyPost = array(
            'API_KEY' => 'EZTK71befb418b3740e4b2f2e26fb289f6cdCtPeuDlUEHTgLjZ7sv0jPQ'
        );
//        $this->config = array(
//            'ShopUrl'      => 'tradlands-app.myshopify.com',
//            'ApiKey'       => 'ac2c96071db4f676e4e7f547fd5e5a29',
//            'Password'     => '44d9ccea22e5acbf49db8cbcb2e7c79a',
//            'SharedSecret' => 'f7725528c756f5340146b9f2afcf503e'
//        );
//        $this->configEasyPost = array(
//            'API_KEY' => 'EZTK71befb418b3740e4b2f2e26fb289f6cdCtPeuDlUEHTgLjZ7sv0jPQ'
//        );

    }

    public function getProducts() {

        $shopify = new \PHPShopify\ShopifySDK($this->config);
        $products = $shopify->Product->get();
        return $products;
    }

    public function getProduct($id = 1089709637668) {

        $shopify = new \PHPShopify\ShopifySDK($this->config);
        return $shopify->Product($id)->get();

    }

    public function createFulfillmentOrder(Request $request) {
        //TODO да се записват поръчките в базата данни
        // Да се проверява дали поръчката вече е записана в нашата база данни
        AcceptOrder::dispatch($this->config, $this->configEasyPost, $request->all());
        return response()->json(['success' => 'success'], 200);

//        $order = Order::where('shopify_id', $request->all()['id'])->first();
//        $this->send_to_easypost = false;
//        //Check if order not exist in our system
//
//        if (!$order) {
//            EasyPost::setApiKey($this->configEasyPost['API_KEY']);
//
//            $easyPostOrderFulfillment['service'] = 'standard';
//            $easyPostOrderFulfillment['destination'] = [
//                'name'        => $request->all()['shipping_address']['name'],
//                "street1"     => $request->all()['shipping_address']['address1'],
//                "city"        => $request->all()['shipping_address']['city'],
//                "state"       => $request->all()['shipping_address']['province_code'],
//                "zip"         => $request->all()['shipping_address']['zip'],
//                "country"     => "US",
//                "residential" => true
//            ];
//
////            foreach ($request->all()['line_items'] as $item) {
////
////                $dbProduct = Product::where('barcode', $item['sku'])->first();
////                if (!$dbProduct) {
////
////                    /*
////                     * TODO this should create new product in easypost and our system
////                     */
////                    $this->createNewProduct(null, null, []);
////                }
////
////                $easyPostOrderFulfillment['line_items'][] = [
////                    //This is for production
////                    "product" => ["barcode" => $item['sku']],
////
////                    //This is for test orders
//////                    "product" => ["barcode" => '132-658-887'],
////                    "units"   => $item['quantity']
////                ];
////                logger($item['sku']);
////            }
//
//            //TEST FULFILLMENT
//            $easyPostOrderFulfillment['line_items'] = [
//                0 => [
//                    "product" => ["barcode" => '21101-31XXS'],
//                    "units"   => 2
//                ],
//                1 => [
//                    "product" => ["barcode" => '21101-82XXS'],
//                    "units"   => 2
//                ]
//            ];
//
//
////            die();
//            //additional product
////            if (count($easyPostOrderFulfillment['line_items']) <= 2) {
////
////                $additionalProduct = $this->getProduct(1089709637668);
////                $easyPostOrderFulfillment['line_items'][] = [
////                    //This is for production
////                    //"product" => ["barcode" => $item['sku']],
////                    //This is for test orders
////                    "product" => ["barcode" => $additionalProduct['barcode']],
////                    "units"   => 1
////                ];
////            }
//
//
//            $client = new Client();
//            //Try to create product in EasypostOrderFulfillment system
//
//            try {
//
//                $res = $client->post('https://api.easypost.com/fulfillment/vendor/v2/orders', [
//                    'headers' => ['Content-type' => 'application/json'],
//                    'auth'    => [
//                        'tLxVX2kdaW3sbGnq80eUSg',
//                        null
//                    ],
//                    'json'    => $easyPostOrderFulfillment
//                ]);
//                $resBody = json_decode($res->getBody(), 1);
//                logger('start fulfillment');
//                logger($resBody);
//                logger('end fulfillment');
//                $this->createOrder($request, $resBody['id']);
//                return response()->json(['success' => 'success'], 200);
//            } catch (ClientException $exception) {
//                logger($exception);
//                return response()->json(['success' => 'success'], 200);
//            }
//            return response()->json(['success' => 'success'], 200);
//        }
    }

//    public function createOrder(Request $request, $easypost_order_id) {
//
//        EasyPost::setApiKey($this->configEasyPost['API_KEY']);
//
//        $addresses['to_address'] = [
//            "name"    => $request->all()['shipping_address']['name'],
//            "street1" => $request->all()['shipping_address']['address1'],
//            "city"    => $request->all()['shipping_address']['city'],
//            "state"   => $request->all()['shipping_address']['province_code'],
//            "zip"     => $request->all()['shipping_address']['zip'],
//            "phone"   => $request->all()['shipping_address']['phone']
//        ];
//
//        /*
//         * TODO to ask what is his from address
//         */
//        $addresses['from_address'] = [
//            "company" => "EasyPost",
//            "street1" => "118 2nd Street",
//            "street2" => "4th Floor",
//            "city"    => "San Francisco",
//            "state"   => "CA",
//            "zip"     => "94105",
//            "phone"   => "415-456-7890"
//        ];
//        $to_address = \EasyPost\Address::create($addresses['to_address']);
//
//
//        //From Address will be only one
//        $from_address = \EasyPost\Address::create($addresses['from_address']);
//
//        $weight_in_oz = $request->all()['total_weight'] * 0.035;
//        //Check if total weight is <= 0
//        // EasyPost don't accept 0 as weight
//
//        if ($request->all()['total_weight'] <= 0) {
//            $weight_in_oz = 0.1;
//        }
//
//
//        logger($weight_in_oz);
//
////            $weight_in_oz = 0;
//
//
//        try {
//            logger('start order');
//
//            $parcel = \EasyPost\Parcel::create(array(
//                "predefined_package" => "LargeFlatRateBox",
//                "weight"             => $weight_in_oz
//                //this is in oz.
//            ));
//
//
//            $shipment = \EasyPost\Shipment::create(array(
//                "to_address"   => $to_address,
//                "from_address" => $from_address,
//                "parcel"       => $parcel
//            ));
//
//            $shipment->buy($shipment->lowest_rate());
//
//            $this->send_to_easypost = true;
//            //                $shipment->insure(array('amount' => 100));
//            logger('end order');
//
//        } catch (Error $error) {
////                FailedOrders()
//            logger('not Sended');
//
//            $message['order_number'] = $request->all()['number'];
//            $message['error_code'] = $error->getHttpStatus();
//            $message['error_message'] = $error->getMessage();
//
//
//            //Log errors in DB
//            InternalError::create([
//                'shopify_order_number' => $request->all()['number'],
//                'error_body'           => json_encode($error)
//            ]);
////                FailedOrders::dispatch($message, $addresses, $this->configEasyPost['API_KEY'], $weight_in_oz)->delay(now()->addMinutes(5));
//            FailedOrders::dispatch($message, $addresses, $this->configEasyPost['API_KEY'], $weight_in_oz, $request->all()['number']);
//
//        }
//
//        /*
//         * TODO If order is successfyly sent to EasyPost
//         * send_to_easypost field should to be updated too
//         */
//
//        Order::create([
//            'shopify_id'               => $request->all()['id'],
//            'shopify_email'            => $request->all()['email'],
//            'shopify_phone'            => $request->all()['phone'],
//            'shopify_total_price'      => $request->all()['total_price'],
//            'shopify_order_number'     => $request->all()['number'],
//            'shopify_total_weight'     => $request->all()['total_weight'],
//            'shopify_line_items'       => json_encode($request->all()['line_items']),
//            'shopify_shipping_address' => json_encode($request->all()['shipping_address']),
//            'shopify_billing_address'  => json_encode($request->all()['billing_address']),
//            'send_to_easypost'         => $this->send_to_easypost,
//            /*
//             * TODO Must delete order_weight
//             */
//            'shopify_order_weight'     => $request->all()['total_weight'],
//            'shopify_all_order'        => json_encode($request->all()),
//            'easypost_to_address'      => $to_address,
//            'easypost_from_address'    => $from_address,
//            'predefined_package'       => 'LargeFlatRateBox',
//            'easypost_parcel_weight'   => $weight_in_oz,
//            'easypost_order_id'        => $easypost_order_id
//
//        ]);
//        return response()->json(['success' => 'success'], 200);
//    }

    public function getDailyOrders() {

//        dd(Carbon::today()->toISOString());
        $shopify = new \PHPShopify\ShopifySDK($this->config);
        $params = array(
//            'created_at_min' => '2019-06-10T16:15:47-04:00'
'created_at_min' => Carbon::yesterday()->toISOString()
        );
        $orders = $shopify->Order->get($params);
        return $orders;
        $failedOrders = Order::whereDate('created_at', Carbon::today())->where('send_to_easypost', false)->get();
//        dd($failedOrders);
        $orders = $shopify->Order->get($params);

        //Extract all id keys from shopify
        $ordersIds = [];
        foreach ($orders as $order) {
            if ($failedOrders->shopoify_order_number == $order['order_number']) {
                $error = InternalError::where('shopify_order_number', $order['order_number'])->first();
                $error_body = json_decode($error->error_body, 1);

                $error_message['order_number'] = $order['order_number'];
                $error_message['error_code'] = $error_body['httpStatus'];
                $error_message['error_message'] = json_decode($error_body, 1)['error']['message'];


                $addresses['to_address'] = [
                    "name"    => $order['shipping_address']['name'],
                    "street1" => $order['shipping_address']['address1'],
                    "city"    => $order['shipping_address']['city'],
                    "state"   => $order['shipping_address']['province_code'],
                    "zip"     => $order['shipping_address']['zip'],
                    "phone"   => $order['shipping_address']['phone']
                ];
                $addresses['from_address'] = [
                    "company" => "EasyPost",
                    "street1" => "118 2nd Street",
                    "street2" => "4th Floor",
                    "city"    => "San Francisco",
                    "state"   => "CA",
                    "zip"     => "94105",
                    "phone"   => "415-456-7890"
                ];
                //Check if total weight is <= 0
                // EasyPost don't accept 0 as weight
                if ($order['total_weight'] <= 0) {
                    $order['total_weight'] = 0.1;
                }
                $weight_in_oz = $order['total_weight'] * 0.035;
                FailedOrders::dispatch($error_message, $addresses, $this->configEasyPost['API_KEY'], $weight_in_oz, $order['number']);
            }
        }

    }

    public function test() {

        $this->createBOL();
        return 'dadada';
        $prod = $this->getProduct();
        dd($prod['variants'][0]['barcode']);
        // $shopify = new \PHPShopify\ShopifySDK($this->config);
        // $sItem = $shopify->Product->count();
        // dd($sItem);

        $id = 1089709637668;
        $shopify = new \PHPShopify\ShopifySDK($this->config);
        $prod = $shopify->Product($id)->get();
        dd($prod);
        return $shopify->Product($id)->get();
        $shopify = $shopify = new \PHPShopify\ShopifySDK($this->config);
        $products = $shopify->Product->get();
//        foreach ($products as $product) {
//            $this->createNewProduct($product);
//        }
        return $products;


// Make Post Fields Array
        $data = [
            'warehouse'          => ['id' => 'wh_24a7e82945634b8593ff168ed49a70d5'],
            'tracking_code'      => '9400136897846127366840',
            'estimated_delivery' => '2018-07-07',
            'comments'           => 'PO#12345',
            'line_items'         => [
                0 => [
                    'product'    => ['barcode' => '123-321-225'],
                    'units'      => 1,
                    'pallets'    => 1,
                    'containers' => 1
                ]
            ]
        ];
        $client = new Client();
        $res = $client->post('https://api.easypost.com/fulfillment/vendor/v2/bols', [
            'headers' => ['Content-type' => 'application/json'],
            'auth'    => [
                'tLxVX2kdaW3sbGnq80eUSg',
                null
            ],
            'json'    => $data
        ]);
        dd($res->getStatusCode());

    }

    /*
     * First argument is when you get all products from shopify second is when you create one or update from shopify
     */
    public function createNewProduct(Request $request) {

        logger('Product Start');
        // if (isset($orderProduct)) {
        //     return;
        // }
        /*
         * New Product from Shopify
         */
//
//        logger('Product create Start');
//        logger($request->all());
//        logger('Product create End');

        // if (isset($request)) {
        $product = $request->all();
        // }
        $easyPostProduct = [];
        foreach ($product['variants'] as $prod_variant) {

            //Add variant title to prod title like it is in Easypost prod dashboard
            if (!$prod_variant['title']) {
                $prod_variant['title'] = '';
            }
            /*
             * TODO rand() should be deleted in production test
             */
            $easyPostProduct['title'] = $product['title'] . ' ' . $prod_variant['title'];


            if (!$prod_variant['barcode']) {
                $prod_variant['barcode'] = $product['title'];
            }

            //Add variant to barcode like it is in Easypost prod dashboard
            $easyPostProduct['barcode'] = $prod_variant['barcode'];
            //Cant find origin country in webhook data
            $easyPostProduct ['origin_country'] = 'US';

            //This is default code for clothing
            $easyPostProduct ['hs_code'] = '6206303041';

            //This is also default
            $easyPostProduct ['type'] = 'merchandise';

            $easyPostProduct ['requires_serial_tracking'] = true;

            /*
             * TODO
             * to check if all size mesures are equal
             */
            $weight = (float)$prod_variant['weight'];
            if ($weight == 0) {
                $weight = 0.6;
            }
            $easyPostProduct ['length'] = ['value' => 12];
            $easyPostProduct ['width'] = ['value' => 8];
            $easyPostProduct ['height'] = ['value' => 1];
            $easyPostProduct ['weight'] = ['value' => $weight];
            $easyPostProduct ['price'] = ['value' => (float)$prod_variant['price']];

            $flag = false;


            $dbProduct = Product::where('barcode', $prod_variant['barcode'])->first();
            if (!$dbProduct) {
                $dbProduct = new Product();
                $dbProduct->title = $easyPostProduct['title'];
                $dbProduct->barcode = $prod_variant['barcode'];
                $dbProduct['variant_id'] = $prod_variant['id'];
                $dbProduct['product_id'] = $prod_variant['id'];

            }

            $client = new Client();
//            logger($easyPostProduct);
            //Try to create product in Easypost system
            try {
                $res = $client->post('https://api.easypost.com/fulfillment/vendor/v2/products', [
                    'headers' => ['Content-type' => 'application/json'],
                    'auth'    => [
                        'tLxVX2kdaW3sbGnq80eUSg',
                        null
                    ],
                    'json'    => $easyPostProduct
                ]);
                $resBody = json_decode($res->getBody(), 1);
                logger(json_decode($res->getBody(), 1));
                $dbProduct->easypost_flag = true;
                $dbProduct->easypost_id = $resBody['id'];
                $dbProduct->save();
                logger('succesfully saved in easypost prod barcode:' . $prod_variant['barcode']);

                response()->json(['success' => 'success'], 200);

            } catch (ClientException $exception) {

                logger('problem with prod barcode:' . $prod_variant['barcode']);
                logger($easyPostProduct);
                logger($exception);
                if (strpos($exception->getMessage(), 'PRODUCT.BARCODE.DUPLICATE')) {
                    logger('barcode duplicate in easypost' . $prod_variant['barcode']);
                    $dbProduct->easypost_flag = true;
                    $dbProduct->save();
                } else {
                    $dbProduct->easypost_flag = false;
                    $dbProduct->save();
                }
            }
            //Create product in our database and set easypost flag if product exists in easypost system
            logger('succesfully saved in our db prod barcode:' . $prod_variant['barcode']);
            return ($dbProduct);
        }
        return response()->json(['success' => 'success'], 200);


    }

    public function createBOL($products = null) {


        $products = Product::pluck('barcode');
        $lineItems = [];
        foreach ($products as $productBarcode) {

            $lineItems = [
                [
                    'product'    => ['barcode' => $productBarcode],
                    'units'      => 30,
                    'pallets'    => 1,
                    'containers' => 1
                ]
            ];
            $client = new Client();
            try {
                logger('barcode: ' . $productBarcode);
                $response = $client->post('https://api.easypost.com/fulfillment/vendor/v2/bols', [
                    'headers' => ['Content-type' => 'application/json'],
                    'auth'    => [
                        'tLxVX2kdaW3sbGnq80eUSg',
                        null
                    ],
                    'json'    => [
                        'warehouse'          => ['id' => 'wh_24a7e82945634b8593ff168ed49a70d5'],
                        //Where to take this
                        'tracking_code'      => '9400136897846127366840',
                        // This too
                        'estimated_delivery' => '2017-01-01',
                        //Where to take different orders
                        'comments'           => 'PO#12345',
                        'line_items'         => $lineItems
                    ]
                ]);
                logger('success barcode: ' . $productBarcode);
            } catch (ClientException $exception) {
                logger('problem with: ' . $productBarcode);

            }

        }

//        $lineItems = [
//            [
//                'product'    => ['barcode' => $products],
//                'units'      => 30,
//                'pallets'    => 1,
//                'containers' => 1
//            ]
//        ];


        dd($response);
    }

    public function easyPostOrder(Request $request) {
        logger('tracking start');
        logger($request->all());
        logger('tracking end');
        $shopify = new \PHPShopify\ShopifySDK($this->config);

        $order = Order::where('easypost_order_id', $request->all()['result']['id'])->first();
        logger('start order');
        logger($order);
        logger('end order');
        if(isset ($request->all()['result']['tracking_code'])){
            $tracker_id = $request->all()['result']['tracking_code'];
            $status = $request->all()['result']['status'];
            $carrier = $request->all()['result']['carrier'];
        }
        elseif (isset ($request->all()['result']['trackers'][0]['tracking_code'])){
            $tracker_id = $request->all()['result']['trackers'][0]['tracking_code'];
            $status = $request->all()['result']['trackers'][0]['status'];
            $carrier = $request->all()['result']['trackers'][0]['carrier'];
        }
        else{
            $tracker_id = '';
            $status = '';
            $carrier = '';
        }
        if ($tracker_id) {
            $order->tracker_id = $tracker_id;
            $order->save();


//        logger('tracker start');
//        logger($request->all());
//        logger('tracker end');

            $params = [
                'tracking_number'  => $tracker_id,
                'tracking_company' => $carrier,
                'status'           => $status
            ];
            $shopify->Order($order->shopify_id)->Fulfillment->post($params);
        }
        return response()->json(['success' => 'success'], 200);
    }
}
