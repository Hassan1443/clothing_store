<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //

  public function load_products_home()
  {
   $products = Product::orderBy('id', 'DESC')->limit(6)->get();
   return view('home', compact('products'));
  }

  public function load_all_products()
  {
   $products = Product::inRandomOrder()->paginate(9);
   return view('products', compact('products'));
  }
  
  public function detail($id)
  {
    $product = Product::find($id);
    return view('single_product_detail', compact('product'));
  }
  
}
