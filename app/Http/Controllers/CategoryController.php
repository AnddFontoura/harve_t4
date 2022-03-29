<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {

        $categories = Category::get();

        return view('admin.category.index', compact('categories'));
    }

    public function form(int $categoryId = null)
    {
        $category = null;

        if ($categoryId) {
            $category = Category::where("id", $categoryId)
                            ->first();
        } 

        return view('admin.category.form', compact ("category"));
    }

    public function save(Request $request, int $categoryId = null )
    {
        $this->validate($request, [
            "name" => "required|string|max:100|min:1"
        ]);

        $name = $request->post("name");

        if ($categoryId){
            $category = Category::where("id", $categoryId)->update([
                "name" => $name
            ]);
        } else {
            $category = Category::create([
                "name" => $name
            ]);
        }

        return redirect("admin/category/list");
    }

    public function destroy(int $categoryId)
    {
       $category = Category::where('id', $categoryId)->delete();

       return redirect("admin/category/list");
    }
}

