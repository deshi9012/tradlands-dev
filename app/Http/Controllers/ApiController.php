<?php

namespace App\Http\Controllers;

use App\Jobs\FailedOrders;
use EasyPost\EasyPost;
use App\InternalError;
use EasyPost\Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Storage;
use App\Order;
use Mail;

class ApiController extends Controller {
    public $config;
    public $configEasyPost;


    function __construct() {
        $this->config = array(
            'ShopUrl'      => 'tradlands-app.myshopify.com',
            'ApiKey'       => 'ac2c96071db4f676e4e7f547fd5e5a29',
            'Password'     => '44d9ccea22e5acbf49db8cbcb2e7c79a',
            'SharedSecret' => 'f7725528c756f5340146b9f2afcf503e'
        );
        $this->configEasyPost = array(
            'API_KEY' => 'EZTK71befb418b3740e4b2f2e26fb289f6cdCtPeuDlUEHTgLjZ7sv0jPQ'
        );

    }

    public function index() {
        \PHPShopify\ShopifySDK::config($this->config);

        //your_authorize_url.php
        $scopes = 'read_orders,write_orders,read_products,write_products';
        //This is also valid
        //$scopes = array('read_products','write_products','read_script_tags', 'write_script_tags');
        $redirectUrl = 'https://tradlands-dev.herokuapp.com/authenticate';

        \PHPShopify\AuthHelper::createAuthRequest($scopes, $redirectUrl);

    }

    private function checkHmac() {
        function verify_webhook($data, $hmac_header) {
            $calculated_hmac = base64_encode(hash_hmac('sha256', $data, SHOPIFY_APP_SECRET, true));
            return hash_equals($hmac_header, $calculated_hmac);
        }


        $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
        $data = file_get_contents('php://input');
        $verified = verify_webhook($data, $hmac_header);
        error_log('Webhook verified: ' . var_export($verified, true)); //check error.log to see the result

    }

    public function authenticate() {

        \PHPShopify\ShopifySDK::config($this->config);
        $accessToken = \PHPShopify\AuthHelper::getAccessToken();
        dd($accessToken);
        //Now store it in database or somewhere else


    }

    public function getProducts() {

        $shopify = new \PHPShopify\ShopifySDK($this->config);
        $products = $shopify->Product->get();
        return $products;
    }

    public function createOrder(Request $request) {

        $order = Order::where('shopify_id', $request->all()['id'])->first();

        //Check if order not exist in our system
        if (!$order) {

            EasyPost::setApiKey($this->configEasyPost['API_KEY']);

            $addresses['to_address'] = [
                "name"    => $request->all()['shipping_address']['name'],
                "street1" => $request->all()['shipping_address']['address1'],
                "city"    => $request->all()['shipping_address']['city'],
                "state"   => $request->all()['shipping_address']['province_code'],
                "zip"     => $request->all()['shipping_address']['zip'],
                "phone"   => $request->all()['shipping_address']['phone']
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
            $to_address = \EasyPost\Address::create($addresses['to_address']);


            //From Address will be only one
            $from_address = \EasyPost\Address::create($addresses['from_address']);
            //Check if total weight is <= 0
            // EasyPost don't accept 0 as weight
            if ($request->all()['total_weight'] <= 0) {
                $request->all()['total_weight'] = 0.1;
            }
            $weight_in_oz = $request->all()['total_weight'] * 0.035;
//            $weight_in_oz = 0;


            try {
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

                //                $shipment->insure(array('amount' => 100));

            } catch (Error $error) {
//                FailedOrders()
                $message['order_number'] = $request->all()['number'];
                $message['error_code'] = $error->getHttpStatus();
                $message['error_message'] = $error->getMessage();


                //Log errors in DB
                InternalError::create([
                    'error_body' => json_encode($error)
                ]);
                FailedOrders::dispatch($message, $addresses,$this->configEasyPost['API_KEY'], $weight_in_oz)->delay(now()->addMinutes(5));

            }

            Order::create([
                'shopify_id'               => $request->all()['id'],
                'shopify_email'            => $request->all()['email'],
                'shopify_phone'            => $request->all()['phone'],
                'shopify_total_price'      => $request->all()['total_price'],
                'shopify_order_number'     => $request->all()['number'],
                'shopify_total_weight'     => $request->all()['total_weight'],
                'shopify_line_items'       => json_encode($request->all()['line_items']),
                'shopify_shipping_address' => json_encode($request->all()['shipping_address']),
                'shopify_billing_address'  => json_encode($request->all()['billing_address']),
                /*
                 * TODO Must delete order_weight
                 */
                'shopify_order_weight'     => $request->all()['total_weight'],
                'shopify_all_order'        => json_encode($request->all()),
                'easypost_to_address'      => $to_address,
                'easypost_from_address'    => $from_address,
                'predefined_package'       => 'LargeFlatRateBox',
                'easypost_parcel_weight'   => $weight_in_oz

            ]);
            return response()->json(['success' => 'success'], 200);
        }
        return response()->json(['success' => 'success'], 200);
    }

    public function getDailyOrders() {
        $shopify = new \PHPShopify\ShopifySDK($this->config);
        $params = array(
            'created_at_min' => '2019-06-19T16:15:47-04:00'
        );

        $orders = $shopify->Order->get();
        return $orders;
    }
}
