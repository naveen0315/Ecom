<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\brand;
use DB;

class BrandController extends Controller
{
    //Show All Brands
    public function index(Request $request){

        $search = $request['search'] ?? "";
        if($search != ""){
            $allBrands = brand::where('Brand_Name','=',"$search")

            ->orWhere('Brand_Name','LIKE',"%$search")
            ->orWhere('Brand_Name','LIKE',"$search%")
            ->orWhere('Brand_Name','LIKE',"%$search%")
            ->paginate(10);
        }
        else {
            $allBrands = brand::paginate(10);
        }
        $data = compact('allBrands', 'search');
        return view('admin.brands')->with($data);

    }
    public function AddBrands(Request $request){

        $validated = $request->validate([
            'brand_name' => ['required', 'string', 'max:255', 'unique:brands'],
        ]);

        $brand_name = $request->input('brand_name');

        $data=array('brand_name' => $brand_name);
        DB::table('brands')->insert($data);

        return redirect()->back()->with('message','Brand Added Successully');
    }
    public function delete($id){

        DB::delete('delete from brands where id = ?',[$id]);
        return redirect()->back()->with('message', 'Brand deleted Successfully');

    }

    // Show Brand For Edit

    public function showBrand($id){
        $Brands = DB::select('select * from brands where id = ?', [$id]);

        return view('admin.editBrand',['Brands' => $Brands]);
    }

    // Edit Brand

    public function editBrand(Request $request, $id){

            // validation starts
            $validated = $request->validate([
                "brand_name"=>['required'],

            ]);

            $brandEdit = brand::whereId($id)->first() ;
            $brandEdit->brand_name=$request->input('brand_name');

            $brandEdit->save();
            return redirect('brands')->with('message', 'Brand Edited Successfully');
    }
}
