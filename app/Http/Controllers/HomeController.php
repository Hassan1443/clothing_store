<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $products = Product::limit(6)->get();
      return view('home', compact('products'));
    }
   //testing images relationship 
  /*  public function index()
    {
      $products = Product::limit(6)->get();
      echo "<pre>";
      foreach ($products as $product) {
        foreach($product->images as $image)
        {
          echo $image->path."<br>";
        }
        echo "<br>iteration ended<br>";
      }
    }*/
    public function about()
    {
        return view('about');
    }
    
    
}
