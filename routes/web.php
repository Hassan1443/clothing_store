<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
  $products = Product::limit(6)->get();
    return view('home', compact('products'));
});*/
Route::get('/', [HomeController::class, 'index']);

Route::get('/about', [HomeController::class, 'about']);

Route::get('/home',[ProductController::class, 'load_products_home']);

Route::post('/orderplace',[OrderController::class, 'place_order']);

Route::get('/checkout',[OrderController::class, 'checkout'])->middleware('auth');

Route::get('/vieworder/{id}',[OrderController::class, 'vieworder']);
Route::get('/evnt',[OrderController::class, 'evt']);

//soft deletes example
Route::get('/softdel', function (){
  Product::find(3)->delete();
});

//Displays the details of single product

/*Route::get('detail/{id}', function ($id){
  $product = Product::find($id);
  return view('single_product_detail', compact('product'));
});*/
Route::get('detail/{id}', [ProductController::class, 'detail']);




Route::get('/restore', function (){
  Product::withTrashed()->find(3)->restore();
});
Route::get('/forcedel', function (){
  Product::withTrashed()->find(3)->forceDelete();
});



Route::get('/products', [ProductController::class, "load_all_products"])->name('products');



//  Cart routes
//Route::get('/', [ProductController::class, 'productList'])->name('products.list');
Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
// Route::get('/products', function () {
//     $products = Product::paginate(6);
//     return view('products', compact("products"));
// })->name("products");

// Route::get('imgt', function(){
//     $d = Product::findOrFail(1);
//    dd( $d->images->first()->path);
// });


//Admin Routes

Route::get('/admin', [AdminController::class, 'index'])->name('admin');

// Route::get('/dbtest', function (){
//     $pdo = DB::connection()->getPdo();

//     if($pdo)
//     {
//         echo "Connected successfully to database ".DB::connection()->getDatabaseName();
//         echo "<br>";
//         echo public_path();
//     } else
//     {
//         echo "You are not connected to database";
//     }
// });

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
