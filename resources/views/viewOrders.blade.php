@extends('layouts.app')
<style>
  #tbl tr td{
    vertical-align: middle;
  }
</style>

@section('content')
<div class="container">
      <label style="font-size:16; font-weight:bold;"> Order No: {{ $order_details['orderId']  }}</label>
      <label style="float:right; color:black; ">Placed On: {{\Carbon\Carbon::parse( $order_details['order_date'])->format('d F, Y') }}</label>
    <table id="tbl" class="table text-center align-middle" >
      <thead class="table-dark">
        <th>Item ID</th>
        <th colspan="2">Name</th>
        <th>Unit Price</th>
        <th>Quantity</th>
        <th>Sub Total</th>
      </thead>
      <tbody>
        @foreach($product_details as $product)

        <tr>
          <td> {{  $product['id'] }}</td>
          <td><img height="100" width="100" alt="Product Image" src="{{ asset($product['image']) }}"  > </td>
          
          <td>{{ $product['name']  }}</td>
          <td>Rs. {{ $product['price']  }}</td>
          <td>{{ $product['quantity']  }}</td>
          <td>Rs. {{ $product['quantity'] *  $product['price'] }}</td>
        </tr>
@endforeach
        <tr style="text-align:right;">
          <td colspan="4"> Total </td>
          <td colspan="2">Rs. {{ $order_details['total_bill']  }}</td>
        </tr>
      
        <tr style="text-align:right;">
          <td colspan="4">Shipment Charges</td>
          <td colspan="2">Rs. {{ $order_details['shipment_charges'] }} </td>
        </tr>
      
        <tr style="text-align:right;">
          <td colspan="4">Discount</td>
          <td colspan="2">Rs. {{ $order_details['discount']  }}</td>
        </tr>
      
        <tr style="text-align:right; font-weight:bold;">
          <td colspan="4">Final Bill</td>
          <td colspan="2">Rs. {{ $order_details['final_amount'] + $order_details['shipment_charges'] - $order_details['discount'] }}</td>
        </tr>
      </tbody>
    </table>
</div>


@endsection
