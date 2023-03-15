<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Barryvdh\DomPDF\PDF;
class OrderEmail extends Mailable
{
    use Queueable, SerializesModels;

public $order_details;
public $product_details;
public $pdf;
//protected $tes;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $order_details, Collection $product_details,  $pdf
      )
    {
        $this->order_details = $order_details;
        $this->product_details = $product_details;
        $this->pdf = $pdf;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Order Placed Successfully.')->view('emails.order_place')->attachData($this->pdf, 'Order # '.$this->order_details['orderId'].'.pdf', [
                    'mime' => 'application/pdf',
                ]);
    }
}
