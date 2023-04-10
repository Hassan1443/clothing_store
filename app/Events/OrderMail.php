<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderMail
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
  public $email;
  public $order_details;
  public $product_details;
//   public $pdf;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($email,$order_details, $product_details )
    {
        //
        $this->email = $email;
        $this->order_details = $order_details;
        $this->product_details = $product_details;
        // $this->pdf = $pdf;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
