<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    // All user Access

    public function index(Request $request){
        $search = $request['search'] ?? "";
        if($search != ""){
            $adminUser = User::where('First_Name','=',"$search")

            ->orWhere('Last_Name','=',"$search")
            ->orWhere('email','=',"$search")
            ->orWhere('mobile','=',$search)

            ->orWhere('First_Name','LIKE',"%$search")
            ->orWhere('First_Name','LIKE',"$search%")
            ->orWhere('First_Name','LIKE',"%$search%")

            ->orWhere('Last_Name','LIKE',"%$search%")
            ->orWhere('Last_Name','LIKE',"%$search%")
            ->orWhere('Last_Name','LIKE',"%$search%")

            ->orWhere('email','LIKE',"%$search%")
            ->orWhere('email','LIKE',"%$search%")
            ->orWhere('email','LIKE',"%$search%")

            ->orWhere('mobile','LIKE',"%$search%")
            ->orWhere('mobile','LIKE',"%$search%")
            ->orWhere('mobile','LIKE',"%$search%")
            ->paginate(5);
        }

        else {
            $adminUser = User::paginate(5);
        }

        $data = compact('adminUser', 'search');
        return view('admin.users')->with($data);
    }

    //Admin Profile Function
    public function profile($id){

        $users = DB::select('select * from users where id = ?', [$id]);
        return view('admin.profile',['users' => $users]);
    }

    //Admin Profile Edit Function
    public function editprofile(Request $request ,$id){

        // validation starts
        $validated = $request->validate([
            "First_Name"=>['required'],
            "Last_Name"=>['required'],
            "email"=>['required'],
            "mobile"=>['required'],
            "gender"=>['required'],
        ]);
        // validation ends

        //Database insertion code starts
        $user = User::whereId($id)->first() ;
        $user->First_Name=$request->input('First_Name');
        $user->Last_Name=$request->input('Last_Name');
        $user->email=$request->input('email');
        $user->mobile=$request->input('mobile');
        $user->gender=$request->input('gender');
        // dd($user);
        $user->save();
        return redirect()->back()->with('message', 'User Edited Successfully');
    }


    //User Status Change Function
    public function changeStatus(Request $request){
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();
        return response()->json(['success'=>'User Status changed successfully.']);
    }


    // Add New Users
    public function newUser(Request $request){

        // dd( $request);
        $newUser = new User();
        $newUser->role_id = 2;
        $newUser->First_Name = $request->input('First_Name');
        $newUser->Last_Name = $request->input('Last_Name');
        $newUser->email = $request->input('email');
        $newUser->mobile = $request->input('mobile');
        $newUser->gender = $request->input('gender');
        $newUser->password = Hash::make($request['password']);
        $newUser->status = 'Active';
        $newUser->save();

        return redirect('users')->with('message','New User Added Successfully');

    }

}
