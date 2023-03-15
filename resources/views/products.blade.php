@extends('layouts.app')
@section('products')

<!-- 
@if (session('addCrtScs'))
   <div class="alert alert-success" role="alert" style="float:right;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Success!</strong>  {{ session('addCrtScs') }}
</div>

@endif -->
<style>
    .wraptext {
     height:40px;
     white-space: nowrap;
     overflow: hidden;
     text-overflow: ellipsis;
}
</style>
    <!-- Page Content -->
    <div class="page-heading products-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>new arrivals</h4>
              <h2>cotton products</h2>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="products">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="filters">
              <ul>
                  <li class="active" data-filter="*">All Products</li>
                  <li data-filter=".des">Featured</li>
                  <li data-filter=".dev">Flash Deals</li>
                  <li data-filter=".gra">Last Minute</li>
              </ul>
            </div>
          </div>
          

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
                <!-- <a href="{{ url('detail',$product->id) }}" class="btn btn-primary btn-sm" style=' float:right; font-size:12px;'> Add to Cart   </a> -->
                <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $product->id }}" name="id">
                        <input type="hidden" value="{{ $product->product_name }}" name="name">
                        <input type="hidden" value="{{ $product->unit_price }}" name="price">
                        <input type="hidden" value="{{ $product->brand }}" name="brand">
                        <input type="hidden" value="{{ $product->category }}" name="category">
                        <input type="hidden" value="{{ $product->image_1 }}"  name="image">
                        <input type="number" style="width:30px; border:grey;" value="1" name="quantity">
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


      




          <!-- <div class="col-md-12">

              <br><br><br>
            <ul class="pages">
              <li><a href="#">1</a></li>
              <li class="active"><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
            </ul>
          </div> -->
        </div>
        <div class="d-flex justify-content-center" > 
         {{ $products->onEachSide(2)->links() }}</div>
        <!-- <center style="align:center;"> {{ $products->links("pagination::bootstrap-4") }}</center> -->

      </div>
    </div>
<pre>

    @endsection
