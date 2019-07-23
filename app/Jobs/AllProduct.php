<?php

namespace App\Jobs;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Product;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class AllProduct implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $config = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct() {

           $this->config = array(
               'ShopUrl'      => 'https://tradlands.myshopify.com',
               'ApiKey'       => 'f1caf89d0c39b9b515ee2e136a2147d4',
               //            'ApiKey'       => '24ffd496be17e6ea65064a8bf7b2e55e',
               //f1caf89d0c39b9b515ee2e136a2147d4 - APIKey
               'Password'     => 'b79dc9ab3df62bcd17bc05d063b90e8c',
               //            'Password'     => 'a78ab8a1ffe51cfb2fbcee11809f433d',
               //b79dc9ab3df62bcd17bc05d063b90e8c - APIPass
               'SharedSecret' => 'f7725528c756f5340146b9f2afcf503e'
           );
        // $this->config = array(
        //     'ShopUrl'      => 'tradlands-app.myshopify.com',
        //     'ApiKey'       => 'ac2c96071db4f676e4e7f547fd5e5a29',
        //     'Password'     => '44d9ccea22e5acbf49db8cbcb2e7c79a',
        //     'SharedSecret' => 'f7725528c756f5340146b9f2afcf503e'
        // );
    }

    /*
     * First argument is when you get all products from shopify second is when you create one or update from shopify
     */
    public function createNewProduct($product) {
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
        // $product = $request->all();
        // }
        $easyPostProduct = [];
        // dd($product);
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
            // dd($dbProduct);
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
                // dd($res);
                $resBody = json_decode($res->getBody(), 1);
                logger(json_decode($res->getBody(), 1));
                $dbProduct->easypost_flag = true;
                $dbProduct->easypost_id = $resBody['id'];
                $dbProduct->save();
                logger('succesfully saved in easypost prod barcode:' . $prod_variant['barcode']);

                // response()->json(['success' => 'success'], 200);

            } catch (ClientException $exception) {
                // dd($exception->getMessage());
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
            // return ($dbProduct);
        }
        // return response()->json(['success' => 'success'], 200);


    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        $config = $this->config;

        $shopify = \PHPShopify\ShopifySDK::config($config);
        $sItem = $shopify->Product->count();
        $iterations = ceil($sItem / 250);
        for ($i = 0; $i < $iterations; $i++) {
            try {
                $products = $shopify->Product->get([
                    'limit' => 250,
                    'page'  => $i + 1
                ]);
                $count = count($products);
                foreach ($products as $product) {
                    $this->createNewProduct($product);
                }
                // $this->createInElastic($products, $this->shop_es_index);
                // foreach ($products as $kk => $prod) { //createInElastic

            } catch (\Exception $e) {
                $message = $e->getMessage();
            }
            // }
        }
    }
}
