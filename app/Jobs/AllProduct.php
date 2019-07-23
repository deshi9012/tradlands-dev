<?php

namespace App\Jobs;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class AllProduct implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct() {

        $this->config = array(
            'ShopUrl'      => 'tradlands-app.myshopify.com',
            'ApiKey'       => 'ac2c96071db4f676e4e7f547fd5e5a29',
            'Password'     => '44d9ccea22e5acbf49db8cbcb2e7c79a',
            'SharedSecret' => 'f7725528c756f5340146b9f2afcf503e'
        );
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {

        $config =$this->config;

        $shopify = \PHPShopify\ShopifySDK::config($config);
        $sItem = $shopify->Product->count();
        $iterations = ceil($sItem / 250);
        for ($i = 0; $i < $iterations; $i++) {
            try {
                $products = $shopify->Product->get([
                    'limit' => 250,
                    'page'  => $i + 1
                ]);
                foreach ($products as $product) {
                    Order::create([])
                }
                // $this->createInElastic($products, $this->shop_es_index);
                // foreach ($products as $kk => $prod) { //createInElastic

            } catch (\Exception $e) {
                $message = $e->getMessage();
                Log::debug($message);
            }
            // }
        }
    }
}
