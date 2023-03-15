@extends('layouts.app')
<style>
  table tr td{
    vertical-align: middle;
  }
</style>
@section('content')
 <div class="row">
   &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
   &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
   &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
   &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
    <div class="col-xs-12">
        @if(count($cartItems))
                          <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <button class="btn btn-warning">Clear Cart</button>
                          </form>
          @endif              
                      
    </div>
      &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
      &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
      &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
    <div class="col-xs-3" style="float:right;" >
      @if(count($cartItems))
        <a style="float:right;" href="{{ url('checkout') }}" class="btn btn-success"> Checkout</a>
      @endif             
    </div>
</div>
                    

          
            <div class="container">
                @if(count($cartItems))  
                    <div class="">
                    <!--   @if ($message = Session::get('success'))
                        <div class="p-4 mb-3 bg-green-400 rounded">
                            <p class="text-green-800">{{ $message }}</p>
                        </div>
                    @endif -->
                        <h3 class="text-3xl text-bold">Cart List</h3>
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
                              <th class="hidden text-right md:table-cell"> Sub Total</th>
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
                                      <input type="number" name="quantity" style="width:30px; text-align:center;" value="{{ $item->quantity }}" readonly ></div>
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
                              
                                
                                    Rs. {{ $item->price*$item->quantity }}
                                
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
                        <div style="float:right;font-weight:bold;">
                         Grand Total: Rs {{ Cart::getTotal() }}
                        </div>
                      </div>
                      </div>  
                 @else
                 <p>
                   No items in Cart
                 </p>
                 
                 @endif
            </div>
                      
          
        
    @endsection

