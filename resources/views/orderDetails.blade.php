@extends('layouts.mail')
<style>
  /* #tbl th tr td{
    vertical-align: middle;
  } */
  td{
    margin-left: 2%;
  }
</style>

@section('content')
<div class="container">
      <label style="font-size:16; font-weight:bold; color:green;"> Order No: {{ $order_details['orderId'] }}</label>
      <label style="float:right; margin-right:5%; ">Placed On: {{\Carbon\Carbon::parse( $order_details['order_date'])->format('d F, Y') }}</label>
        <br>
        <br>
      <table id="tbl" style="width:100%;" class="table text-center align-middle" >
      <thead class="table-dark">

        <th></th>
        <th>Item ID</th>
        <th>Name</th>
        <th>Unit Price</th>
        <th>Quantity</th>
        <th>Sub Total</th>
      </thead>
      <tbody>
        @foreach($product_details as $product)

        <tr style="text-align:center;">

          <td>
                <img height="80" width="80" alt=""src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path($product['image']))) }}">
          </td>
          <td style="margin-left: 15px;"> {{  $product['id'] }}</td>
          <td>{{ $product['name']  }}</td>
          <td>Rs. {{ $product['price']  }}</td>
          <td>{{ $product['quantity']  }}</td>
          <td>Rs. {{ $product['quantity'] *  $product['price'] }}</td>
        </tr>
@endforeach
        <tr style="text-align:right; ">
          <td colspan="5" > Total </td>
          <td colspan="1"style="padding-right:25%;">Rs. {{ $order_details['total_bill']  }}</td>
        </tr>

        <tr style="text-align:right;">
          <td colspan="5">Shipment Charges</td>
          <td colspan="1" style="padding-right:25%;">Rs. {{ $order_details['shipment_charges'] }} </td>
        </tr>

        <tr style="text-align:right;">
          <td colspan="5">Discount</td>
          <td colspan="1" style="padding-right:25%;">Rs. {{ $order_details['discount'] }}</td>
        </tr>

        <tr style="text-align:right; font-weight:bold;">
          <td colspan="5">Final Bill</td>
          <td colspan="1" style="padding-right:25%;">Rs. {{ $order_details['final_amount'] + $order_details['shipment_charges'] - $order_details['discount'] }}</td>
        </tr>
      </tbody>
    </table>
</div>


@endsection
