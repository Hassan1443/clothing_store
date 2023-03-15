@extends('layouts.app')

@section('content')
 <div class="row">
                       &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
   &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
   &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
   &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
  
    <div class="col-xs-6">
  @if(count($cartItems))
                          <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <button class="btn btn-warning">Clear Cart</button>
                          </form>
                        @endif
                      
    </div>
  
    </div>    
            <div class="container">
                
                    <div class="">
                    <!--   @if ($message = Session::get('success'))
                        <div class="p-4 mb-3 bg-green-400 rounded">
                            <p class="text-green-800">{{ $message }}</p>
                        </div>
                    @endif
                                       -->      <h3 class="text-3xl text-bold">Cart List</h3>
                      <div class="">
                        
                        <table class="table" cellspacing="0">
                          <thead>
                            <tr class="h-12 uppercase">
                              <th class="hidden md:table-cell"></th>
                              <th class="text-left">Name</th>
                              <th >
                                  
                                <span class="hidden lg:inline">Quantity</span>
                              </th>
                              <th class="hidden text-right md:table-cell">Unit Price</th>
                              <th class="hidden text-right md:table-cell"> Remove </th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach ($cartItems as $item)
                            <tr>
                              <td class="hidden pb-4 md:table-cell">
                                <a href="#">
                                  <img height="80" width="80" src="{{ $item->attributes->image }}" class="w-20 rounded" alt="Thumbnail">
                                </a>
                              </td>
                              <td>
                                <a href="#">
                                  <p class="mb-2 md:ml-4">{{ $item->name }}
                                    @if(!is_null($item->color))
                                  ({{ $item->color }})
                                  @endif
                                </p>
                                  
                                </a>
                              </td>
                              <td style="dispaly:inline;">
                              <!--   <div class="">
                                <div class=""> -->
                              
                                
                      &nbsp;&nbsp;&nbsp;     <div class="row" style="margin-left:2%;">
    <div class="col-xs-4">
                                <form action="{{ route('cart.update') }}" method="POST">
                                      @csrf
                                      <input type="hidden" name="id" value="{{ $item->id}}" >
                                      <input type="hidden" name="quantity" value="{{ $item->quantity}}" >
                                      <input type="hidden" name="substract" value="1" >
                              
                                    <button type="submit" class="btn btn-sm btn-primary">-</button>
                                    </form>
                                </div>
    <div class="col-xs-4">
                                      <input type="number" name="quantity" style="width:30px;" value="{{ $item->quantity }}" readonly ></div>
    <div class="col-xs-4">
                                    <form action="{{ route('cart.update') }}" method="POST">
                                      @csrf
                                      <input type="hidden" name="id" value="{{ $item->id}}" >
                                      <input type="hidden" name="quantity" value="{{ $item->quantity}}" >
                                      <input type="hidden" name="add" value="1" >
                                 
                              
                                  <button type="submit" class="btn btn-sm btn-primary">+</button>
                                    </form></div>
</div>   
                              
                              
                              
                                
                          
                             
                                
                                        
                                <!--   </div>
                                                                </div>
                                                               --></td>
                              <td class="hidden text-right md:table-cell">
                                <span class="text-sm font-medium lg:text-base">
                                    Rs. {{ $item->price }}
                                </span>
                              </td>
                              <td class="hidden text-right md:table-cell">
                                <form action="{{ route('cart.remove') }}" method="POST">
                                  @csrf
                                  <input type="hidden" value="{{ $item->id }}" name="id">
                                  <button class="btn btn-sm btn-danger">x</button>
                              </form>
                                
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                        <div style="float:right;font-face:bold;">
                         Total: Rs {{ Cart::getTotal() }}
                        </div>
                        
                        
                        
                        
                        
                        
          
</div>

                      </div>
                    </div>
                  
            </div>
            
            
            
<div class="container" style="width:70%; margin-top:10%;">
  <form action="{{ url('orderplace')  }}"method="POST">
  @csrf
  
  <div class="form-group">
    <label for="shipping_address">Shipping Adddress</label>
    <input type="text" class="form-control" id="shipping_address" name="shipping_address" placeholder="">
  </div>
  
  <div class="form-group">
    <label for="contact">Mobile Number</label>
    <input type="tel" class="form-control" id="contact" name="contact" placeholder="Mobile No" pattern="[0-9]{4}+-[0-9]{7}" >
    <small>Example: 0300-1234567</small>
  </div>
  
  <div class="form-group">
    <label for="discount">Shipment Charges</label>
    <input type="number" class="form-control" id="shipment_charges" name="shipment_charges" readonly value="25" placeholder="">
  </div>
  
  <div class="form-check">
    <label for="discount">Billing Method</label><br>
    <input type="radio" class="form-check-input" id="billing_method1"name="billing_method" value="COD" > <label class="form-check-label">Cash on Delivery</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="radio" value="AP" class="form-check-input" id="billing_method2"name="billing_method" ><label class="form-check-label">Advance Payment</label><br><br>
  </div>
  
  <div class="form-group">
    <button class="form-control">Process</button>
  </div>
  </form>
  
</div>  
        
    @endsection


