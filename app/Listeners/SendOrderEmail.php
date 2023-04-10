<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\OrderMail;
use App\Mail\OrderEmail;
//use Illuminate\Support\Facades\Mail;
use Mail;
use PDF;
class SendOrderEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Registered  $event
     * @return void
     */
    public function handle(OrderMail $event)
    {
       // echo "from listener send order email<br>";
      //  echo "<script> window.alert(' ".$event->email."') </script>";

        //echo $event->email;

        $pdf = PDF::loadView('orderDetails',['order_details'=>$event->order_details, 'product_details'=>$event->product_details])->setOptions(['defaultFont' => 'sans-serif',])->download('order.pdf');

        Mail::to($event->email)->send(new OrderEmail($event->order_details, $event->product_details, $pdf));
    }
}
