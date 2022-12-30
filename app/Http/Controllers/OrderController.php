<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\cart;
use App\Models\address;
use App\Models\refund_order;
use App\Models\Return_Order;
use App\Models\Shipment;
use App\Models\Product;
use App\Models\payment;
use App\Models\OrderItem;
use Auth;
use DB;
class OrderController extends Controller
{
    //
    public function index(){
        $adminOrder = Order::all();
        return view('admin.orders',['adminOrder'=>$adminOrder]);
    }

    public function ShowEditOrders($id){
        $addressUser = User::whereId(Auth::id())->with('user_address')->get();
        $orderTable = Order::whereId($id)->get();
        // dd($orderTable );
        $orderView = OrderItem::where('order_id',$id)->with('productData')->get();
        return view('admin.editOrders')->with(['orderView'=>$orderView , 'addressUser'=> $addressUser , 'orderTable'=> $orderTable]);
    }

    public function editOrders(Request $request, $id){

        $shipment = new Shipment();
        $shipment->shipment_status = 'Shipped';
        $shipment->tracking_no = $request->input('tracking_no');
        $shipment->save();

        $updateOrdersTable = Order::whereId($id)->first() ;
        $updateOrdersTable->shipment_id = $shipment->id;
        $updateOrdersTable->order_status = 'Shipped';
        $updateOrdersTable->save();

        return redirect()->back()->with('message','Tracking Number Updated Successfully');

    }

    // Display All Orders In User Dashboard
    public function UserOrder(){
        if (Auth::id()) {
            $orders = Order::where('user_id',Auth::id())->sortable()->paginate(8);
            return view('allOrders')->with(['orders'=>$orders]);
        }
        else {
            return redirect()->back()->with('message','Login First');
        }
    }

    // View Order
    public function view($id){
        if (Auth::id()) {

            // $addressUser = User::whereId(Auth::id())->with('user_address')->get();
            $orderTable = Order::whereId($id)->get();
            foreach ($orderTable as $value) {
            $addressUser = address::whereId($value->address_id)->get();
            }
            $orderView = OrderItem::where('order_id',$id)->with('productData')->get();
            return view('orderView')->with(['orderView'=>$orderView , 'addressUser'=> $addressUser , 'orderTable'=> $orderTable]);
        }
        else{
            return redirect()->back()->with('message','Login First');
        }
    }

    // Display Return Order Items
    public function OrderReturn($id){

        $returnAddress = User::whereId(Auth::id())->with('user_address')->get();
        $returnData = OrderItem::where('order_id',$id)->with('productData')->get();
        return view('returnOrder')->with(['returnData'=>$returnData , 'returnAddress'=>$returnAddress ]);
    }

    // Return Order and Refund Amount TO User
    public function returnedOrder(Request $request, $id){
        // Pickup Address Add In Address Table

        $orderItems = OrderItem::where('order_id', $id)->where('product_id', $request->product_id)->get();

        // dd($request->Quanaity);
        foreach ($orderItems as $value) {

            $checkpayment = Order::find($value->order_id);
            $findpayment = payment::find($checkpayment->payment_id);

            $checkProduct = Product::find($request->product_id);

            if ($value->quantity >= $request->quantity) {
                $amount = $checkProduct->price * $request->quantity;
                // dd($amount);

            $stripe = new \Stripe\StripeClient('sk_test_51MBVzzSI7Xxcd3IkRNW1hkLtWhsgEJjWjIbJrNEXdS4GfwQjVbZglg2eRXfbHPmrgvdRseUva347lKHHt5y62G0K00PhlvA9HD');

            $refund = $stripe->refunds->create(['payment_intent' => $findpayment->transcation_no, 'amount' => $amount*100]);

            // Payment Data Store In Payment Table
            $payment = new refund_order();
            $payment->amount= $amount;
            $payment->transaction_id= $refund->id;
            $payment->save();

            $Returnorder = new Return_Order();
            $Returnorder->user_id= Auth::id();
            $Returnorder->order_id= $id;
            $Returnorder->refund_id= $payment->id;
            $Returnorder->quantity= $request->quantity;
            $Returnorder->save();

            $validated = $request->validate([
                // 'product_id' => ['required'],
                'First_Name' => ['required', 'string'],
                'Last_Name' => ['required', 'string'],
                'email' => ['required', 'string'],
                'mobile' => ['required', 'numeric', 'digits:10'],
                'address' => ['required', 'string'],
                'state' => ['required', 'string'],
                'city' => ['required', 'string'],
                'district' => ['required', 'string'],
                'pincode' => ['required', 'numeric', 'digits:6'],
            ]);

            $address = address::where('user_id', Auth::id())->first();
            $address->First_Name =$request->input('First_Name');
            $address->Last_Name=$request->input('Last_Name');
            $address->email=$request->input('email');
            $address->mobile=$request->input('mobile');
            $address->address=$request->input('address');
            $address->state=$request->input('state');
            $address->city=$request->input('city');
            $address->district=$request->input('district');
            $address->pincode=$request->input('pincode');
            $address->save();

            $checkQty = OrderItem::where('order_id', $id)->where('product_id', $request->product_id)->get();
            // dd($checkQty);
            foreach ($checkQty as $value) {
                $OrderItems = OrderItem::whereId($value->id)->first() ;
                if ($value->quantity == $request->quantity) {
                    $OrderItems->order_status= 'Fully Refunded';
                }
                else {
                    $OrderItems->order_status += $request->quantity;
                }
                $OrderItems->quantity = $value->quantity - $request->quantity;
                $OrderItems->save();
            }
            return redirect('thanks')->with('error','Return Request For an item from your order ' . $id .' has been accepted');
        }
        else {
            return redirect()->back()->with('error','Something Wrong!!!!');
        }

        }
    }

    // Order Cancel
    public function OrderCancel($id){

        $cancelOrder = Order::find($id);

        $checkpayment = payment::find($cancelOrder->payment_id);

        $stripe = new \Stripe\StripeClient('sk_test_51MBVzzSI7Xxcd3IkRNW1hkLtWhsgEJjWjIbJrNEXdS4GfwQjVbZglg2eRXfbHPmrgvdRseUva347lKHHt5y62G0K00PhlvA9HD');

        $check = $stripe->paymentIntents->retrieve($checkpayment->transcation_no);
        if ($check->amount_received == '0') {
            $orderUpdate = Order::whereId($id)->first() ;
            $orderUpdate->order_status= 'Cancel';
            $orderUpdate->save();

            return redirect('thanks')->with('error','Cancel Request For your order ' . $id .' has been accepted');
        }
        else {
        $refund = $stripe->refunds->create(['payment_intent' => $checkpayment->transcation_no, 'amount' => $cancelOrder->amount*100]);
        $orderUpdate = Order::whereId($id)->first() ;
        $orderUpdate->order_status= 'Cancel';
        $orderUpdate->save();

        // Payment Data Store In Payment Table
        $payment = new refund_order();
        $payment->amount= $cancelOrder->amount;
        $payment->transaction_id= $refund->id;
        $payment->save();

        // Order Data Store In Order Table
        $Returnorder = new Return_Order();
        $Returnorder->user_id= Auth::id();
        $Returnorder->order_id= $id;
        $Returnorder->refund_id= $payment->id;
        $Returnorder->quantity= 1;
        $Returnorder->save();

        $checkQty = OrderItem::where('order_id', $id)->get();
        foreach ($checkQty as $key => $value) {
            // dd($value);
            $OrderItems = OrderItem::whereId($value->id)->first() ;
            $OrderItems->order_status= 'Cancel';
            $OrderItems->save();
        }

        return redirect('thanks')->with('error','Cancel Request For your order ' . $id .' has been accepted');
    }
    }
    // Direct Order Products Click On Buy Button
    public function buy($id){

        $product = Product::findOrFail($id);
        // dd($product);

        $cart_pro = new cart ;
        $cart_pro->user_id=Auth::id();
        $cart_pro->price=$product->price;
        $cart_pro->quantity=1;
        $cart_pro->product_id=$id;
        $cart_pro->save();

        $userCheckoutOld = cart::where('user_id', Auth::id())->get();
        foreach ($userCheckoutOld as $value)
        {
            if (!Product::where('id',$value->product_id)->where('quantity','>=',$value->quantity)->exists())
            {
                $removeItem = cart::where('user_id', Auth::id())->where('product_id', $value->product_id)->first();
                $removeItem->delete();
            }

        }
        $addressUser = User::whereId(Auth::id())->with('user_address')->get();
        $userCheckout = cart::where('user_id', Auth::id())->get();
        return view('checkout')->with(['userCheckout'=>$userCheckout, 'addressUser'=>$addressUser]);
    }
}
