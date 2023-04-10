<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    //
        public function cartList()
    {
        $cartItems = \Cart::getContent();
       //  dd($cartItems);
        return view('cart', compact('cartItems'));
    }


    public function addToCart(Request $request)
    {
     //echo "<pre>";
     // dd($request);
      \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'brand' => $request->brand,
            'category' => $request->category,
            'price' => $request->price,
            'color'=> $request->color,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->image,
            )
        ]);
      //  session()->flash('addCrtScs', 'Product Added to Cart Successfully !');

        return redirect()->back()->with('addCrtScs', 'Product Added to Cart Successfully !');
    }

    public function updateCart(Request $request)
    {

      $quantity = $request->quantity;
      if($request->add)
      {
        $quantity = $quantity + 1;
      }
      else if($request->substract)
      {
        if($request->quantity > 1)
        {
          $quantity = $quantity - 1;
        }
      }


        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $quantity
                ],
            ]
        );

        session()->flash('updScs', ' Cart is Updated Successfully !');

        return redirect()->route('cart.list');
    }

    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        session()->flash('remScs', 'Cart Item Removed Successfully !');

        return redirect()->route('cart.list');
    }

    public function clearAllCart()
    {
        \Cart::clear();

        session()->flash('clrScs', 'Cart Cleared Successfully !');

        return redirect()->route('cart.list');
    }
}
