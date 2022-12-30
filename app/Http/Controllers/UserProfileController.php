<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;
use App\Models\address;
use Auth;

class UserProfileController extends Controller
{
    // // User Profile Function

    public function UserProfile($id){

        $addressUser = address::where('user_id', $id)->get();

        $users = DB::select('select * from users where id = ?', [$id]);

        return view('userprofile',['users' => $users , 'addressUser'=>$addressUser]);
    }

    public function editUserProfile(Request $request ,$id){

        // $image = $request->file('image');

        $validated = $request->validate([
            "image"=>[''],
            "First_Name"=>['required'],
            "Last_Name"=>['required'],
            "email"=>['required'],
            "mobile"=>['required'],
            "gender"=>['required'],

        ]);
        // validation ends

        if ($request->file('image') == '') {
            $user = User::whereId($id)->first() ;
            $user->First_Name=$request->input('First_Name');
            $user->Last_Name=$request->input('Last_Name');
            $user->email=$request->input('email');
            $user->mobile=$request->input('mobile');
            $user->gender=$request->input('gender');
            // $user->image=$teaser_image;
            $user->save();
            return redirect()->back()->with('message', 'User Edited Successfully');
        }
        else {
            $request->hasFile('image');
            $image = $request->file('image');
            $teaser_image = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/profile');
            $image->move($destinationPath, $teaser_image);

            $user = User::whereId($id)->first() ;
            $user->First_Name=$request->input('First_Name');
            $user->Last_Name=$request->input('Last_Name');
            $user->email=$request->input('email');
            $user->mobile=$request->input('mobile');
            $user->gender=$request->input('gender');
            $user->image=$teaser_image;
            $user->save();
            return redirect()->back()->with('message', 'User Edited Successfully');
        }
    }

    public function AddAddress(Request $request){


        $validated = $request->validate([
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

        $userAddress = new address();
        // dd($userAddress);
        $userAddress->First_Name=$request->input('First_Name');
        $userAddress->Last_Name=$request->input('Last_Name');
        $userAddress->email=$request->input('email');
        $userAddress->mobile=$request->input('mobile');
        $userAddress->address=$request->input('address');
        $userAddress->state=$request->input('state');
        $userAddress->city=$request->input('city');
        $userAddress->district=$request->input('district');
        $userAddress->pincode=$request->input('pincode');
        $userAddress->user_id= Auth::id();

        // dd($userAddress);
        $userAddress->save();
        return redirect()->back()->with('message', 'User Address added Successfully');
    }

    public function index($id){

        // dd($id);
        $newAddressUser = address::whereId($id)->get();
        return view('editAddress',['newAddressUser'=>$newAddressUser]);
    }

    public function editUserAddress(Request $request ,$id){

        $validated = $request->validate([
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
        $userAddress = address::whereId($id)->first() ;
        // dd($userAddress);
        $userAddress->First_Name=$request->input('First_Name');
        $userAddress->Last_Name=$request->input('Last_Name');
        $userAddress->email=$request->input('email');
        $userAddress->mobile=$request->input('mobile');
        $userAddress->address=$request->input('address');
        $userAddress->state=$request->input('state');
        $userAddress->city=$request->input('city');
        $userAddress->district=$request->input('district');
        $userAddress->pincode=$request->input('pincode');
        // dd($userAddress);
        $userAddress->save();
        return redirect()->back()->with('message', 'User Address Edited Successfully');
    }


}
