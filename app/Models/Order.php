<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
  //  protected $table = 'orders';
    protected $fillable = [
      'customer_id',
      'customer_name',
      'customer_email',
      'customer_contact',
      'order_description',
      'order_status',
      'billing_address',
      'total_bill',
      'shipment_charges',
      'discount',
      'final_amount',
      'billing_method',
    ];
}
