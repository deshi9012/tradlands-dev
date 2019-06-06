<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller {
    function __construct() {
        $config = array(
            'ShopUrl'      => 'tradlands-dev.myshopify.com',
            'ApiKey'       => 'ce9450750762d0b561e6c01d0ea4bcfa',
            'Password'     => '5cc26c57636bb101393bbd38bf08a621',
            'SharedSecret' => 'db91a6d35099fd7de5ea5d3015d1660b'
        );

        \PHPShopify\ShopifySDK::config($config);

    }

    public function authorize() {
        //your_authorize_url.php
        $scopes = 'read_products,write_products,read_script_tags,write_script_tags';
        //This is also valid
        //$scopes = array('read_products','write_products','read_script_tags', 'write_script_tags');
        $redirectUrl = 'https://yourappurl.com/your_redirect_url.php';

        \PHPShopify\AuthHelper::createAuthRequest($scopes, $redirectUrl);
    }
}
