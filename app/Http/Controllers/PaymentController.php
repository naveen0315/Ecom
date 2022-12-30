<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stripe\Exception\CardException;
use Stripe\StripeClient;
use App\Models\Order;

class PaymentController extends Controller
{
    public function index(){
        $paymentTable = Order::paginate(10);
        return view('admin.payments')->with(['paymentTable'=>$paymentTable]);
    }
}
