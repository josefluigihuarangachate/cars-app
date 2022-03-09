<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    function index(){
        $categories = Category::all();
        $id = 1;
        return view("category.index", compact("categories", "id"));
    }

    function create(){
        return view("category.create");
    }

    function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {

            $Category = new Category;
            $Category->name = $request->name;
            $Category->slug = Str::slug($request->name);
            $Category->save();

            return response()->json(["status" => true, "msg" => "You have successfully create new Category", "redirect_location" => url("/category/create")]);
        }
    }

    function edit($id){
        $category = Category::find($id);
        return view("category.edit", compact("category"));
    }

    function update(Category $category, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {

            $category->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name)
            ]);

            return response()->json(["status" => true, "msg" => "You have successfully edit Category ", "redirect_location" => url("/categories")]);
        }
    }

    public function delete(Category $category)
    {
        $category->delete();

        return back()->with('success', 'Category has been deleted');
    }



}
