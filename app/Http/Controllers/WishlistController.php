<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\wishlist;
use Auth;
use DB;
class WishlistController extends Controller
{
    //
    public function wish(){

        if (Auth::id()) {
            $wishData = wishlist::where('user_id',Auth::id())->with('Products')->paginate(5);
            return view('wishlist')->with(['wishData'=>$wishData]);
        }
        else {
            return redirect()->back()->with('message','Login First');
        }
    }

    public function addWish($id){
        // dd($id);

        $wishListCheck = wishlist::where('product_id', $id)->get();
        foreach ($wishListCheck as $value) {
            if ($value->product_id == $id) {
                return redirect()->back()->with('message', 'Product Already Added Into To Wishlist!!');
            }
        }
        $addWishData = new wishlist();
        $addWishData->user_id = Auth::id();
        $addWishData->product_id = $id;
        $addWishData->save();

        return redirect()->back()->with('message','Product Added In Wishlist');
    }

    public function wishRemove($id){
        DB::delete('delete from wishlists where product_id = ?',[$id]);
        return redirect()->back()->with('message','Product Deleted Successfully');
    }

    public function wishcount(){

        $cartcount = wishlist::where('user_id', Auth::id())->count();
        return response()->json(['count'=> $cartcount]);
    }
}
