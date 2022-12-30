<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\brand;
use DB;
class IndexController extends Controller
{
    // All Product Display on Index Page
    public function AllProducts(Request $request){
        $search = $request['search'] ?? "";
        if($search != ""){
            $AllCat = Product::where('product_name','=',"$search")
            ->orWhere('product_name','LIKE',"%$search")
            ->orWhere('product_name','LIKE',"$search%")
            ->orWhere('product_name','LIKE',"%$search%")
            ->sortable()->paginate(6);
        }
        else {
            $AllCat = Product::paginate(6);
        }
        $data = compact('AllCat', 'search');
        return view('index')->with($data);

    }

    // All Products Display On All Products Page
    public function index(Request $request){

        $search = $request['search'] ?? "";
        if($search != ""){
            $AllPro = Product::where('product_name','=',"$search")
            ->orWhere('product_name','LIKE',"%$search")
            ->orWhere('product_name','LIKE',"$search%")
            ->orWhere('product_name','LIKE',"%$search%")
            ->sortable()->paginate(10);
        }
        else {
            $AllPro = Product::paginate(10);
        }
        $data = compact('AllPro', 'search');
        return view('userProducts')->with($data);

    }

    // Single Product Details Page
    public function view($id){

        $singleProduct = Product::whereId($id)->with('brand')->get();
        return view('userProductDetails')->with(['singleProduct' => $singleProduct]);

    }
}
