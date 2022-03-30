<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function index(Request $request)
    {

        $categories = Category::where('name', 'like', $request->get('name').'%')->paginate(20);

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

    public function destroy(Request $request)
    {   
        $categoryId = $request->post('id');
        $category = Category::where('id', $categoryId)->first();

        if($category){
            $category->delete(); 
            
            return response()->json(["message"=>"Deu boa"],Response::HTTP_OK);
        }
        
        return response()->json(["message"=>"Deu ruim"],Response::HTTP_NOT_ACCEPTABLE);
    }
}

