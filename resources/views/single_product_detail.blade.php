@extends('layouts.app')

<style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: Arial;
    }

    /* The grid: Four equal columns that floats next to each other */
    .column {
      float: left;
      margin-left: 3.4%;
      width: 29%;
      padding: 10px;
    }

    /* Style the images inside the grid */
    .column img {
      opacity: 0.8;
      cursor: pointer;
    }

    .column img:hover {
      opacity: 1;
    }

    /* Clear floats after the columns */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    /* The expanding image container */
    .container1 {
      position: relative;
      display: block;
    }

    /* Expanding image text */
    #imgtext {
      position: absolute;
      bottom: 15px;
      left: 15px;
      color: white;
      font-size: 20px;
    }

    /* Closable button inside the expanded image */
    .closebtn {
      position: absolute;
      top: 10px;
      right: 15px;
      color: white;
      font-size: 35px;
      cursor: pointer;
    }

        /* Create two equal columns that floats next to each other */
        .column1 {
          float: left;
          width: 50%;
          padding: 10px;
          background: rgb(218, 214, 212);
          /* Should be removed. Only for demonstration */
        }

        /* Clear floats after the columns */
        .row:after {
          content: "";
          display: table;
          clear: both;
        }
    .crop {
        width: 200px;
        height: 150px;
        overflow: hidden;
    }

    .crop img {
        width: 400px;
        height: 300px;
        margin: -75px 0 0 -100px;
    }
        
        
        
        </style>


    @section('products')

        <div class="row">
          <div class="column1" >
            <div class="container1">
                {{-- <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span> --}}
                <img id="expandedImg" src="{{ asset($product->images->first()->path ) }}" alt="Nature" style="width:100%">
                
                {{-- <div id="imgtext">Mature</div> --}}
              </div>

              <!-- The four columns -->
              <div class="row">
                @foreach($product->images as $image)
                <div class="column ">
                  <img src="{{asset($image->path) }}" alt="Nature" style="width:98%; overflow:auto;" onclick="myFunction(this);">
                </div>
                
                @endforeach
              <!--  <div class="column">
                  <img src="{{ asset($product->image_2) }}" alt="Snow" style="width:98%" onclick="myFunction(this);">
                </div>
                <div class="column">
                  <img src="{{ asset($product->image_3) }}" alt="Mountains" style="width:98%" onclick="myFunction(this);">
                </div>-->

              </div>
          </div>
          <div class="column1"  style="border: 1px solid rgb(206, 204, 201);">
                <h1>{{ $product->product_name }}</h1>

                <br>
                <h3>Price: Rs. {{ $product->unit_price }}</h3>
                <br>
                <p>
                    {{$product->description }}
                </p>
                
                
                 <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        @if(count($product->colors))
                
                  
                  @foreach($product->colors as $color)
                  <label>
                    <input type="radio" name="color" value="{{$color->colorName}}">
                  
                  {{$color->colorName}}
                  </label>
                  <br>
                  @endforeach
                
                  @endif
                        <input type="hidden" value="{{ $product->id }}" name="id">
                        <input type="hidden" value="{{ $product->product_name }}" name="name">
                        <input type="hidden" value="{{ $product->unit_price }}" name="price">
                        <input type="hidden" value="{{ $product->brand }}" name="brand">
                        <input type="hidden" value="{{ $product->category }}" name="category">
                        <input type="hidden" value="{{ $product->images->first()->path  }}"  name="image">
                        <input type="number" style="width:30px; border:grey;text-align:center;" value="1" name="quantity">
                      
                         <button class="btn btn-primary btn-sm" style="float:right; font-size:12px;">Add To Cart</button> 
                    </form>
               
          </div>
        </div>





    <script>
    function myFunction(imgs) {
      var expandImg = document.getElementById("expandedImg");
      var imgText = document.getElementById("imgtext");
      expandImg.src = imgs.src;
      imgText.innerHTML = imgs.alt;
      expandImg.parentElement.style.display = "block";
    }
    </script>



@endsection
