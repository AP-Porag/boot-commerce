<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\str;


class CategoryController extends Controller
{
    public function index(){

        $categories = Category::latest()->get();

        return response()->json($categories,200);

    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
        ]);
        $category = Category::create([
           'name'=>$request->name,
            'slug'=>str::slug($request->name)
        ]);
        return response()->json('Success',200);
    }

    public function edit(Category $category)
    {
        if ($category){
            return response()->json($category,200);
        }else{
            return response()->json("Failed",404);
        }
    }

    public function destroy(Category $category)
    {
        if ($category){
            $category->delete();
            return response()->json('Success',200);
        }else{
            return response()->json("Failed",404);
        }

    }




}
