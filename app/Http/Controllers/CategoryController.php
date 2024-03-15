<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('post.category',compact('categories'));
    }

    public function store(Request $request)
    {
        Category::create([
            "name" => $request->name,
            "description" => $request->description,
        ]);
        return redirect()->back()->with('success', 'دسته بندی  ' . $request['name'] . ' با موفقیت افزوده شد');

    }

    public function destroy($id){
        Category::find($id)->delete();
        return redirect()->back()->with('success', 'دسته بندی حذف شد');

    }
}
