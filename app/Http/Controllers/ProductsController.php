<?php

namespace App\Http\Controllers;

use App\Models\brand;
use App\Models\category;
use App\Models\cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Auth;
class ProductsController extends Controller
{
    // All Brands and Category Function
    public function index(){

        $AllBrands = brand::all();
        $AllCategory = category::all();
        return view('admin.products')->with(['AllBrands' => $AllBrands, 'AllCategory' => $AllCategory]);

    }

    // Add Products Function
    public function Addproducts(Request $request){

        $validated = $request->validate([
            'product_name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string','max:3000'],
            'cat_id' => ['required'],
            'brand_id' => ['required'],
            'price' => ['required', 'numeric'],
            'image' => ['required','mimes:jpeg,bmp,png'],
            'quantity' => ['required', 'string', 'max:255'],
            'color' => ['required', 'string', 'max:255'],
            'size' => ['required'],
        ]);

        $request->hasFile('image');
        $image = $request->file('image');
        $teaser_image = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/upload');
        $image->move($destinationPath, $teaser_image);

        $product_name = $request->input('product_name');
        $description = $request->input('description');
        $cat_id = $request->input('cat_id');
        $brand_id = $request->input('brand_id');
        $price = $request->input('price');
        $imagee = $teaser_image;
        $quantity = $request->input('quantity');
        $color = $request->input('color');
        $size = $request->input('size');

        $data=array('product_name' => $product_name,'description' => $description,'cat_id' => $cat_id,'brand_id' => $brand_id,
        'price' => $price,'image' => $imagee,'quantity' => $quantity,'color' => $color,'size' => $size);

        DB::table('products')->insert($data);

        return redirect('allproducts')->with('message','Product Added Successully');
    }

    // All Products Function
    public function Products(Request $request){

        $search = $request['search'] ?? "";
        if($search != ""){
            $AllProducts = Product::where('product_name','=',"$search")

            ->orWhere('price','=',$search)

            ->orWhere('product_name','LIKE',"%$search")
            ->orWhere('product_name','LIKE',"$search%")
            ->orWhere('product_name','LIKE',"%$search%")

            ->orWhere('price','LIKE',"%$search%")
            ->orWhere('price','LIKE',"%$search%")
            ->orWhere('price','LIKE',"%$search%")
            ->sortable()->paginate(5);
        }

        else {
            $AllProducts = Product::sortable()->paginate(5);
        }

        $data = compact('AllProducts', 'search');
        return view('admin.allproducts')->with($data);

        // return view('admin.allproducts')->with(['AllProducts' => $AllProducts]);
    }

    // Delete Products Function
    public function delete($id){

        DB::delete('delete from products where id = ?',[$id]);
        return redirect('allproducts')->with('message', 'Product deleted Successfully');

    }

    // Edit Product Show Function
    public function showProduct($id){
        $AllBrand = brand::get();
        $AllCategories = category::get();
        $ProEdit = DB::select('select * from products where id = ?', [$id]);
        return view('admin.editProducts', ['ProEdit'=>$ProEdit,'AllBrand' => $AllBrand, 'AllCategories' => $AllCategories]);

    }

    // Edited Product Submit Data Function
    public function editProduct(Request $request ,$id){

        $validated = $request->validate([
            'product_name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'cat_id' => ['required', 'string',],
            'brand_id' => ['required', 'string',],
            'price' => ['required', 'numeric'],
            'image' => ['','mimes:jpeg,bmp,png'],
            'quantity' => ['required', 'string', 'max:255'],
            'color' => ['required', 'string', 'max:255'],
            'size' => ['required'],
        ]);

        if ($request->file('image') == '') {
            $ProductEdit = Product::whereId($id)->first() ;
            $ProductEdit->product_name=$request->input('product_name');
            $ProductEdit->description=$request->input('description');
            $ProductEdit->cat_id=$request->input('cat_id');
            $ProductEdit->brand_id=$request->input('brand_id');
            $ProductEdit->price=$request->input('price');
            // $ProductEdit->image=$teaser_image;
            $ProductEdit->quantity=$request->input('quantity');
            $ProductEdit->color=$request->input('color');
            $ProductEdit->size=$request->input('size');

            $ProductEdit->save();
            return redirect('allproducts')->with('message','Product Updated Successully');

        }
        else{
            $request->hasFile('image');
            $image = $request->file('image');
            $teaser_image = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/upload');
            $image->move($destinationPath, $teaser_image);

            $ProductEdit = Product::whereId($id)->first() ;
            $ProductEdit->product_name=$request->input('product_name');
            $ProductEdit->description=$request->input('description');
            $ProductEdit->cat_id=$request->input('cat_id');
            $ProductEdit->brand_id=$request->input('brand_id');
            $ProductEdit->price=$request->input('price');
            $ProductEdit->image=$teaser_image;
            $ProductEdit->quantity=$request->input('quantity');
            $ProductEdit->color=$request->input('color');
            $ProductEdit->size=$request->input('size');

            $ProductEdit->save();
            return redirect('allproducts')->with('message','Product Updated Successully');
        }


    }

    // Single Product Details Page
    public function view($id){
        $singleProduct = Product::whereId($id)->with('brand')->get();
        return view('admin.adminProductDetails')->with(['singleProduct' => $singleProduct]);

    }

    // Admin Shopping Cart Function
    public function cart(){

        $ShopCart = cart::with('product')->get();
        return view('admin.cart')->with(['ShopCart' => $ShopCart]);

    }

    // User Shopping Cart Page
    public function userCart(){

        $userCart = cart::where('user_id', Auth::id())->with('Product')->get();
        // dd($userCart);
        return view('cart',['userCart'=>$userCart]);

    }



}
