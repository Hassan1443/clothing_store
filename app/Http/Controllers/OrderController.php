<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facade\Redirect;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Mail\OrderEmail;
use PDF;
use Mail;
use Illuminate\Support\Facades\View;
use Cart;

class OrderController extends Controller
{

    // protected function generatePDF( $order_details, $product_details)
    // {
    //     $data = [

    //         'title' => 'Welcome to ItSolutionStuff.com',

    //         'date' => date('m/d/Y'),
    //         'product_details'=>$product_details,
    //         'order_details'=>$order_details,

    //     ];
    //     $pdf = PDF::loadView('orderDetails', $data);
    //    // $pdf = PDF::loadView('orderDetails', ['order_details'=>$order_details, 'product_details'=>$product_details]);
    //   // Storage::put('public/invoice.pdf', $pdf->output());
    //    return $pdf->download($order_details['orderId'].'.pdf');
    // }

public function vieworder($id)
    {
      $order = Order::where('id',$id)->get();
    // dd($order);
    //  $order = Order::where('customer_id',$id)->get();

    foreach ($order as $ord)
    {
    // $oid = $ord->id;
    //echo "<br><pre>";

       $det = Str::of($ord->order_description)->explode('|');
     //  var_dump($det);
     $order_details = collect(['orderId'=>$ord->id, 'discount'=>$ord->discount, 'total_bill'=>$ord->total_bill, 'final_amount'=>$ord->final_amount,
       'order_date'=>$ord->created_at,'shipment_charges'=>$ord->shipment_charges]);
     $product_details = [];

       foreach ($det as $d)
       {
         $dts = Str::of($d)->explode('_');
        // var_dump($dts);
         $p = Product::findOrFail($dts[0]);
         $product_details[$d] = ['id'=>$p->id, 'name'=>$p->product_name, 'image'=>$p->image_1 ,'quantity'=>$dts[1], 'price'=>$dts[2],
         ];
        //echo $p->product_name."<br>";
       }


      }
      //  $pdf = PDF::loadView('orderDetails',[$product_details, $order_details])->download('order.php');
       // return $pdf->download('order.pdf');
    // echo "<pre>";
      //var_dump($order_details);
     // var_dump($product_details);
     // var_dump($order);

      return view('viewOrders', compact(['order_details', 'product_details']));


    }



    //
  public function place_order(Request $request)
    {
     // echo "<pre>";
     // dd($request->session()->get('4yTlTDKu3oJOfzD_cart_items'));

     $cart_items = $request->session()->get('4yTlTDKu3oJOfzD_cart_items');
     $collection = collect([]);
   $product_details = collect([]);
     $ttl =0;
     $discount =0;
    foreach ($cart_items as $item)
    {
      $ordr= ['id'=>$item['id'],'name'=>$item['name'], 'quantity'=>$item['quantity'], 'price'=>$item['price'] , 'image'=>$item['attributes']['image'],  ];
      $product_details = $product_details->concat([$ordr]);
     $strn =$item['id'].'_'.$item['quantity']."_".$item['price'];
     if(!is_null($item['color']))
     {
       $strn .='_'.$item['color'];
     }
     // echo $strn;
      $ttl += $item['quantity']*$item['price'];
    //  echo "<br>";
      $collection = $collection->concat([$strn]);
     // echo $collection;
    //  echo "<br>";

   /*  print_r($item['id']);
     print_r('<br>');
     print_r($item['price']);
     print_r('<br>');
     print_r($item['quantity']);
     print_r('<br>');
     print_r($request->user()->name);
     print_r('<br>');
     print_r($request->user()->email);
     print_r('<br>');
     print_r($request->user()->user_type);
     print_r('<br>');
     print_r('<br>');
     */



    }

  $desc = (string)$collection->implode('|');

  $save = Order::create([
        'customer_id'=>$request->user()->id,
        'customer_name'=>$request->user()->name,
        'customer_email'=>$request->user()->email,
        'customer_contact'=>$request->contact,
        'order_description'=>$desc,
        'order_status'=>'pending',
        'total_bill'=>$ttl,
        'shipment_charges'=>$request->shipment_charges,
        'final_amount'=>($ttl+$request->shipment_charges),
        'billing_method'=>$request->billing_method,
        'billing_address'=>$request->shipping_address,
      ]);

      $order_details = ['orderId'=>$save->id, 'total_bill'=>$ttl, 'shipment_charges'=>$request->shipment_charges,'discount'=>0 ,'final_amount'=>$ttl, 'order_date'=>$save->created_at];

    //  echo "<pre>";
    //  dd($order_details);
   //   echo "<br><br><br><br><br><br><br>";
//      dd($product_details);

/*$contxt = stream_context_create([
'ssl' => [
'verify_peer' => FALSE,
'verify_peer_name' => FALSE,
'allow_self_signed'=> TRUE
]
]);*/

//$pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
//$pdf->getDomPDF()->setHttpContext($contxt);




    session()->forget('4yTlTDKu3oJOfzD_cart_items');
    // $pdf = app('dompdf.wrapper');
   //  $pdf->getDomPDF()->setHttpContext($contxt);
  // $html =View::make('orderDetails',compact(['order_details', 'product_details']));
  // dd($html);
   //echo $html->render();

   // $pdf = $this->generatePDF($order_details, $product_details);

   // $pdf1 = PDF::loadHTML($html);
   // $pdf=$pdf1->download('order.pdf');
      //$pdf = PDF::loadView('orderDetails',compact(['order_details', 'product_details']))->setOptions(['defaultFont' => 'sans-serif',])->save(public_path($order_details['orderId'].'.pdf'))->download('order.pdf');
      $pdf = PDF::loadView('orderDetails',compact(['order_details', 'product_details']))->setOptions(['defaultFont' => 'sans-serif',])->download('order.pdf');
     // dd($pdf);

      Mail::to($request->user())->send(new OrderEmail($order_details, $product_details, $pdf));

    return view('orderDetails', compact(['order_details', 'product_details']))->with('ordRcvd','Order Received....');


     // return redirect('/home')->with('status', 'Order placed Successfully.....');



    /*  $order = new Order;
      // rebuilding the order to display in site
      $expl0 = (string)$collection;
      echo(gettype($expl0));
      $expl = Str::of($expl0)->explode('|');

     // echo(gettype($collection));
     // $expl =  $collection->toArray();
      //dd($cart_items);
     // var_dump($expl);

//$array = json_decode(json_encode($expl), true);
//var_dump($array);
        print_r('<br>');
      echo(gettype($expl));
  //   var_dump($expl);
      $res=[];

      foreach ($expl as $p)
      {
        print_r('<br>');
       print_r($p);

     //   $res = Str::of($p)->explode('_');
      //  print_r($res);
      }*/
    }

    public function checkout()
    {
      $cartItems = Cart::getContent();
       return view('checkout', compact('cartItems'));
    }




}
