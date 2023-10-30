<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryResourceCollection;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::orderBy('id','DESC')->get()->keyBy->id;
        return new CategoryResourceCollection($categories);
    }

    public function create(CategoryRequest $request) {
        $categories = new Category();
        $request->validated();
        $categories->title = $request->title;
        $file_name = "";
        if($request->hasFile('image')) {
            $file_name = $request->file('image')->store('categories', 'public');
        } else {
            $file_name = null;
        }
        $categories->image = $file_name;
        $result = $categories->save();
        if($result) {
            return response()->json(['message' => 'Create category successfully']);
        } else {
            return response()->json(['message' => 'Create category fail']);
        }

    }

    public function edit($id) {
        $categories = Category::findOrFail($id);
        return new CategoryResourceCollection($categories);
    }

    public function update(Request $request, $id) {
        $categories = Category::findOrFail($id);
        $destination = public_path("storage\\".$categories->image);
        $file_name = "";
        if($request->hasFile('image')) {
            if(File::exists($destination)) {
                File::delete($destination);
            }
            $file_name = $request->file('image')->store('categories', 'public');
        } else {
            $file_name = $request->image;
        }
        $categories->title = $request->title;
        $categories->image = $file_name;
        $result = $categories->save();

        if($result) {
            return response()->json(['message' => 'Update category successfully']);
        } else {
            return response()->json(['message' => 'Update category fail']);
        }
    } 

    public function delete($id) {
        $categories = Category::findOrFail($id);
        $destination = public_path("storage\\".$categories->image);
        if(File::exists($destination)) {
            File::delete($destination);
        }
        $result = $categories->delete();
        if($result) {
            return response()->json(['message' => 'Delete category successfully']);
        } else {
            return response()->json(['message' => 'Delete category fail']);
        };

    }
}
