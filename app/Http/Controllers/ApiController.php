<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
class ApiController extends Controller {
    public $config;

    function __construct() {
        $this->config = array(
            'ShopUrl'      => 'tradlands-dev.myshopify.com',
            'ApiKey'       => 'ce9450750762d0b561e6c01d0ea4bcfa',
            'Password'     => '5cc26c57636bb101393bbd38bf08a621',
            'SharedSecret' => 'db91a6d35099fd7de5ea5d3015d1660b'
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
        $hmac_header = 'HTTP_X_SHOPIFY_HMAC_SHA256';
        $calculated_hmac = base64_encode(hash_hmac('sha256', $request->all(), $this->config['SharedSecret'], true));
        $verified = hash_equals($hmac_header, $calculated_hmac);

        Storage::put('file.txt', 'Webhook verified: ' . var_export($verified, true));

    }
}
