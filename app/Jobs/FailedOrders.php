<?php

namespace App\Jobs;

use App\Order;
use EasyPost\EasyPost;
use EasyPost\Error;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class FailedOrders implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $message;
    protected $addresses;
    protected $parcel;
    protected $email = 'ilia.bojadzhiev@gmail.com';
    protected $easy_post_key;
    protected $weight_in_oz;
    protected $order_number;

    public function __construct($message, $addresses, $easy_post_key, $weight_in_oz, $order_number) {
        $this->message = $message;
        $this->addresses = $addresses;
        $this->weight_in_oz = $weight_in_oz;
        $this->easy_post_key = $easy_post_key;
        $this->order_number = $order_number;
//        $this->parcel = $parcel;
        //

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
//        throw new \Exception('whoops');
        //

        logger('jere');
        EasyPost::setApiKey($this->easy_post_key);
        $to_address = \EasyPost\Address::create($this->addresses['to_address']);


        //From Address will be only one
        $from_address = \EasyPost\Address::create($this->addresses['from_address']);
        $parcel = \EasyPost\Parcel::create(array(
            "predefined_package" => "LargeFlatRateBox",
            "weight"             => $this->weight_in_oz
            //this is in oz.
        ));


        $shipment = \EasyPost\Shipment::create(array(
            "to_address"   => $to_address,
            "from_address" => $from_address,
            "parcel"       => $parcel
        ));

        $shipment->buy($shipment->lowest_rate());

        /*
         * TODO If order is successfyly sent to EasyPost
         * send_to_easypost field should to be updated too
         */

        $order = Order::where('shopify_order_number', $this->order_number)->first();
        if($order){
            $order->send_to_easypost = true;
            $order->save();
        }
    }

    /**
     * The job failed to process.
     *
     * @param  Exception $exception
     * @return void
     */
    public function failed(Error $error = null) {
        // Send user notification of failure, etc...
        logger('failedJOB');
        $message = $this->message;
        $email = $this->email;

        Mail::send('email.easyPostError', ['data' => $message], function ($m) use ($message, $email) {
            $m->to($email)->subject('Something went wrong with order! ');
        });


    }
}
