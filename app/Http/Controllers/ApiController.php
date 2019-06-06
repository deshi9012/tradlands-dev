<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $scopes = 'read_orders,write_orders';
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
}
