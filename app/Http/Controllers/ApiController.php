<?php

namespace App\Http\Controllers;

use EasyPost\EasyPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Storage;

class ApiController extends Controller {
    public $config;
    public $configEasyPost;


    function __construct() {
        $this->config = array(
            'ShopUrl'      => 'tradlands-dev.myshopify.com',
            'ApiKey'       => 'ce9450750762d0b561e6c01d0ea4bcfa',
            'Password'     => '5cc26c57636bb101393bbd38bf08a621',
            'SharedSecret' => 'db91a6d35099fd7de5ea5d3015d1660b'
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

        $order = [];
        Log::info($request->all());

        $order['shopify_id'] = $request->all()['id'];
        $order['shopify_email'] = $request->all()['email'];
        $order['shopify_total_price'] = $request->all()['total_price'];
        $order['shopify_order_number'] = $request->all()['number'];
        $order['shopify_total_weight'] = $request->all()['email'];
        $order['shopify_line_items'] = $request->all()['email'];
        $order['shopify_shipping_address'] = $request->all()['email'];
        $order['shopify_billing_address'] = $request->all()['email'];
        $order['shopify_order_weight'] = $request->all()['email'];
        $order['shopify_all_order'] = $request->all();


        EasyPost::setApiKey($this->configEasyPost['API_KEY']);

        $to_address = \EasyPost\Address::create(array(
                "name"    => "Dr. Steve Brule",
                "street1" => "179 N Harbor Dr",
                "city"    => "Redondo Beach",
                "state"   => "CA",
                "zip"     => "90277",
                "phone"   => "310-808-5243"
            ));

        $from_address = \EasyPost\Address::create(array(
                "company" => "EasyPost",
                "street1" => "118 2nd Street",
                "street2" => "4th Floor",
                "city"    => "San Francisco",
                "state"   => "CA",
                "zip"     => "94105",
                "phone"   => "415-456-7890"
            ));
        $parcel = \EasyPost\Parcel::create(array(
                "predefined_package" => "LargeFlatRateBox",
                "weight"             => 76.9
                //this is in oz.
            ));
        $shipment = \EasyPost\Shipment::create(array(
                "to_address"   => $to_address,
                "from_address" => $from_address,
                "parcel"       => $parcel
            ));

        $shipment->buy($shipment->lowest_rate());

        $shipment->insure(array('amount' => 100));


        Log::info('hahahahah' . $shipment->postage_label->label_url);

    }
}
