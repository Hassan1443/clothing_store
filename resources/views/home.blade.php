@extends('layouts.app')


<style>
    .wraptext {
     height:40px;
     white-space: nowrap;
     overflow: hidden;
     text-overflow: ellipsis;
}
</style>

@section('products')
<!-- 

@if (session('addCrtScs'))
   <div class="alert alert-success" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Success!</strong>  {{ session('addCrtScs') }}
</div>

@endif -->
 <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="banner header-text">
      <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
          <div class="text-content">
            <h4>Best Offer</h4>
            <h2>New Arrivals On Sale</h2>
          </div>
        </div>
        <div class="banner-item-02">
          <div class="text-content">
            <h4>Flash Deals</h4>
            <h2>Get your best products</h2>
          </div>
        </div>
        <div class="banner-item-03">
          <div class="text-content">
            <h4>Last Minute</h4>
            <h2>Grab last minute deals</h2>
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->

    <div class="latest-products">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Latest Products</h2>
              <a href="{{route('products')}}">view all products <i class="fa fa-angle-right"></i></a>
            </div>
          </div>
          <!-- Product starts here -->

           {{-- {!! Form::open(['method'=>'GET','files'=>true,'url'=>'products' ]) !!}
          {!! Form::Text('name') !!}
          {!! Form::submit("Click Me") !!}
          {!! Form::close() !!} --}}
          
          
          
          <!-- 
        {{--  <div class="carousel-item active">
                    <img class="d-block w-100" src="{{$product->image_1}}" alt="First slide">
                    </div>
                    <div class="carousel-item">
                    <img class="d-block w-100" src="{{$product->image_2}}"  alt="Second slide">
                    </div>
                    <div class="carousel-item">
                    <img class="d-block w-100" src="{{$product->image_3}}"  alt="Third slide">
                    </div>  --}}
          
          -->

  @if(count($products))
    @foreach ($products as $product)
        <div class="col-md-4">
            <div class="product-item">
              <a href="{{ url('detail',$product->id) }}">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                  @if(count($product->images))
                   @foreach($product->images as $image) 
                    <div class="carousel-item @if($loop->first)
                    active
                    @endif">
                    <img class="d-block w-100" src="{{$image->path}}" alt=" slide image">
                    </div>
                    @endforeach
         @else
         <div class="carousel-item active">
                    <img class="d-block w-100" src="{{$product->image_1}}" alt="First slide">
                    </div>
                    <div class="carousel-item">
                    <img class="d-block w-100" src="{{$product->image_2}}"  alt="Second slide">
                    </div>
                    <div class="carousel-item">
                    <img class="d-block w-100" src="{{$product->image_3}}"  alt="Third slide">
                    </div>
         
         @endif
                   
                   
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                </div>

              <div class="down-content">
                <a href="#"><h4>{{$product->product_name}}</h4></a>
                <h6>Rs. {{$product->unit_price}}</h6>
                <p class="wraptext">
                {{$product->description}}
               </p>

                </a>
                <!-- <ul class="stars">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                </ul> -->
                <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $product->id }}" name="id">
                        <input type="hidden" value="{{ $product->product_name }}" name="name">
                        <input type="hidden" value="{{ $product->unit_price }}" name="price">
                        <input type="hidden" value="{{ $product->brand }}" name="brand">
                        <input type="hidden" value="{{ $product->category }}" name="category">
                        <input type="hidden" value="{{ $product->image_1 }}"  name="image">
                        <input type="number" style="width:30px; border:grey; text-align:center;" value="1" name="quantity">
                      <!--   <input type="submit" class="btn btn-primary btn-rounded" style="float:right; font-size:12px;" name="add_to_cart" value="Add to Cart"   />
                                             -->  
                      <button class="btn btn-primary btn-sm" style="float:right; font-size:12px;">Add To Cart</button> 
                    </form>
               
              </div>
            </div>
          </div>
   @endforeach
    @else
    <h2>No Products Found</h2>
    @endif
        </div>
      </div>
    </div>

    <!--
    @if(count($products))
    @foreach ($products as $product)
       {{$product->product_name }}
    @endforeach
    @endif-->


    <!-- product ends here -->

    <div class="best-features">
      <div class="container">
        <div class="row">
        
        </div>
      </div>
    </div>



@endsection
