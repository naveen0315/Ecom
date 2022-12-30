<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\category;

class CategoryController extends Controller
{
    //Show All Categeories
    public function index(){

        $allCategory = category::all();
        return view('admin.category', ['allCategory'=>$allCategory]);
    }

    // Add Category
    public function AddCategory(Request $request){

        $validated = $request->validate([
            'categories_name' => ['required', 'string', 'max:255', 'unique:categories'],
        ]);

        $categories_name = $request->input('categories_name');

        $data=array('categories_name' => $categories_name);
        DB::table('categories')->insert($data);

        return redirect()->back()->with('message','Category Added Successully');
    }

    // Delete Category
    public function delete($id){

        DB::delete('delete from categories where id = ?',[$id]);
        return redirect()->back()->with('message', 'Category deleted Successfully');

    }

    // Show Category For Edit
    public function showCategory($id){
        $Category = DB::select('select * from categories where id = ?', [$id]);

        return view('admin.editCategory',['Category' => $Category]);
    }

    // Edit Category

    public function editCategory(Request $request, $id){

            // validation starts
            $validated = $request->validate([
                "categories_name"=>['required'],

            ]);
            // validation ends

            //Database insertion code starts
            $CategoryEdit = category::whereId($id)->first() ;
            $CategoryEdit->categories_name=$request->input('categories_name');

            $CategoryEdit->save();
            return redirect('category')->with('message', 'Category Edited Successfully');
    }
}
