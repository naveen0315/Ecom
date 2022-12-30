<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\payment;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\address;
use Session;
use Stripe;
use Auth;
use DB;
use App\Http\Controllers\Exception;
class CheckoutController extends Controller
{

    public function AddToCart($id){
        $product = Product::findOrFail($id);

        // Check Product Already Stored In Cart Or Not
        $cartDataCheck = cart::where('product_id', $id)->get();
        foreach ($cartDataCheck as $value) {
            if ($value->product_id == $id) {
                return redirect()->back()->with('message', 'Product Already Added Into To Cart!!');
            }
        }
        $cart_pro = new cart ;
        $cart_pro->user_id=Auth::id();
        $cart_pro->price=$product->price;
        $cart_pro->quantity=1;
        $cart_pro->product_id=$id;
        $cart_pro->save();

        return redirect()->back()->with('message', 'Product Added To Cart Successfully!');
    }

    public function cartcount(){

        $cartcount = cart::where('user_id', Auth::id())->count();
        return response()->json(['count'=> $cartcount]);
    }

    public function checkoutCart(Request $request){

        $addressUser = address::where('user_id', Auth::id())->get();
        // dd($dd);

        // $addressUser = User::whereId(Auth::id())->with('user_address')->get();

        $userCheckoutOld = cart::where('user_id', Auth::id())->get();

        foreach ($userCheckoutOld as $value)
        {
            if (!Product::where('id',$value->product_id)->where('quantity','>=',$value->quantity)->exists())
            {
                $removeItem = cart::where('user_id', Auth::id())->where('product_id', $value->product_id)->first();
                $removeItem->delete();
            }
        }
        $userCheckout = cart::where('user_id', Auth::id())->get();

        return view('checkout')->with(['userCheckout'=>$userCheckout, 'addressUser'=>$addressUser]);
    }

// public function userAddesses(Request $request){

    //     // $validated = $request->validate([
    //     //     'categories_name' => ['required', 'string', 'max:255', 'unique:categories'],
    //     // ]);

    //     $First_Name = $request->input('First_Name');
    //     $Last_Name = $request->input('Last_Name');
    //     $email = $request->input('email');
    //     $mobile = $request->input('mobile');
    //     $address = $request->input('address');
    //     $state = $request->input('state');
    //     $city = $request->input('city');
    //     $district = $request->input('district');
    //     $pincode = $request->input('pincode');

    //     $data=array('First_Name' => $First_Name,'Last_Name' => $Last_Name,'email' => $email,'mobile' => $mobile,'address' => $address,
    //     'state' => $state,'city' => $city,'district' => $district,'pincode' => $pincode);
    //     DB::table('addresses')->insert($data);

    //     return redirect()->back()->with('message','Address Added Successully');
// }

    // Remove Product Quantity In Cart Page
    public function remove($id){
        DB::delete('delete from carts where product_id = ?',[$id]);
        return redirect()->back()->with('message','Product Deleted Successfully');
    }

    // Updtate Product Quantity In Cart Page
    public function update(Request $request){

        $prod_id = $request->input('product_id');
        $product_qty = $request->input('quantity');

        $productPrice = Product::find($prod_id);
        $total = $productPrice->price*$product_qty;

        // $price = $request->input('prices');

        if (cart::where('product_id', $prod_id )->where('user_id', Auth::id())->exists()) {
            $cart = cart::where('product_id', $prod_id)->where('user_id', Auth::id())->first();
            $cart->quantity = $product_qty;
            $cart->price = $total;
            $cart->update();
            return response()->json(['status'=>"Quantity Updated"]);
        }
    }

    public function orderPlace(Request $request){

        // dd($request);
        // Cash On Delivery
        if ($request->input('payment') == 'COD'){

            // // Address ID Update In User Table Start
            // $userAdd = User::where('id', Auth::id())->first();
            // $userAdd->address_id = $request->address;
            // $userAdd->update();

            // // Payment Data Store In Payment Table
            // $payment = new payment();
            // $payment->transcation_no= rand(1000000, 9999999);
            // $payment->payment_type= $request->input('payment');
            // $payment->payment_status= 'Hold';
            // $payment->save();

            // $amount = cart::where('user_id', Auth::id())->sum('price');

            // // Order Data Store In Order Table
            // $order = new Order();
            // $order->user_id= Auth::id();
            // $order->payment_id= $payment->id;
            // $order->amount= $amount;
            // $order->address_id= $address->id;
            // $order->order_status= 'Hold';
            // $order->save();

            // // Ordered Item Store In OrderItems Table
            // $cartItem = cart::where('user_id', Auth::id())->get();
            // foreach ($cartItem as $item) {
            //     OrderItem::create([
            //         'order_id' =>  $order->id,
            //         'product_id' => $item->product_id,
            //         'quantity' => $item->quantity,
            //         'price' => $item->price,

            //     ]);
            //     // Minus Product Qunaityt After Order Successfully Ordered
            //     $products = Product::where('id', $item->product_id)->first();
            //     $products->quantity = $products->quantity - $item->quantity;
            //     $products->update();
            // }

            // // Remove The Cart Item After Order The Items
            // $cartItem = cart::where('user_id', Auth::id())->get();
            // cart::destroy($cartItem);

            // // Redirect the Page After Order
            // return redirect('thanks');

            return redirect('checkout')->with('message','Cash On Delivery Enable soon!! Plzz Try Online Mode');

        }
        else{

            // Online Mode
            \Stripe\Stripe::setApiKey('sk_test_51MBVzzSI7Xxcd3IkRNW1hkLtWhsgEJjWjIbJrNEXdS4GfwQjVbZglg2eRXfbHPmrgvdRseUva347lKHHt5y62G0K00PhlvA9HD');

            $amount = cart::where('user_id', Auth::id())->sum('price');

            $payment_intent = \Stripe\PaymentIntent::create([
                'description' => 'Online Payment Mode',
                'amount' =>  $amount*100,
                'currency' => 'INR',
                'description' => 'Payment From' .' '.Auth::user()->First_Name .' '.Auth::user()->Last_Name ,
                'payment_method_types' => ['card'],
                'receipt_email' => 'naveengoyal002@gmail.com',
            ]);

            $intent = $payment_intent->client_secret;

            // Payment Data Store In Payment Table
            $payments = new payment();
            $payments->transcation_no= $payment_intent->id;
            $payments->payment_type= $request->input('payment');
            $payments->payment_status= 'Hold';
            $payments->save();

            // Order Data Store In Order Table
            $orders = new Order();
            $orders->user_id= Auth::id();
            $orders->payment_id= $payments->id;
            $orders->amount= $amount;
            $orders->address_id= $request->address;
            $orders->order_status= 'Hold';
            $orders->save();

            // Ordered Item Store In OrderItems Table
            $cartItem = cart::where('user_id', Auth::id())->get();

            foreach ($cartItem as $item) {
                OrderItem::create([
                    'order_id' =>  $orders->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'order_status' => 0,
                ]);
                // Minus Product Qunaityt After Order Successfully Ordered
                $products = Product::where('id', $item->product_id)->first();
                $products->quantity = $products->quantity - $item->quantity;
                $products->update();
            }
            // Remove The Cart Item After Order The Items
            $cartItem = cart::where('user_id', Auth::id())->get();
            cart::destroy($cartItem);

            // Redirect the Page After Order
            return view('payment',compact('intent'));

        }
    }

    public function afterPayment(){
        return redirect('thanks')->with('message','We received your purchase request');
    }

    public function Thanku(){
        return view('thanks');
    }

}
