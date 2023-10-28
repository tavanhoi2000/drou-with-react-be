<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductResourceCollection;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index() {
        $products = Product::orderBy('id','DESC')->get()->keyBy->id;
        return new ProductResourceCollection($products);
    }

    public function create(ProductRequest $request) {
        $products = new Product();
        $request->validated();
        $products->title = $request->title;
        $products->description = $request->description;
        $products->price = $request->price;
        $products->thumb_image = $request->thumb_image;
        $file_name = "";
        if($request->hasFile('image')) {
            $file_name = $request->file('image')->store('products', 'public');
        } else {
            $file_name = null;
        }
        $products->image = $file_name;
        $result = $products->save();
        if($result) {
            return response()->json(['message' => 'Create product successfully']);
        } else {
            return response()->json(['message' => 'Create product fail']);
        }

    }

    public function edit($id) {
        $product = Product::findOrFail($id);
        return new ProductResource($product);
    }

    public function update(Request $request, $id) {
        $products = Product::findOrFail($id);
        $destination = public_path("storage\\".$products->image);
        $file_name = "";
        if($request->hasFile('image')) {
            if(File::exists($destination)) {
                File::delete($destination);
            }
            $file_name = $request->file('image')->store('products', 'public');
        } else {
            $file_name = $request->image;
        }

        $products->title = $request->title;
        $products->image = $file_name;
        $products->description = $request->description;
        $products->price = $request->price;
        $products->thumb_image = $request->thumb_image;
        $result = $products->save();

        if($result) {
            return response()->json(['message' => 'Update product successfully']);
        } else {
            return response()->json(['message' => 'Update product fail']);
        }
    } 

    public function delete($id) {
        $products = Product::findOrFail($id);
        $destination = public_path("storage\\".$products->image);
        if(File::exists($destination)) {
            File::delete($destination);
        }
        $result = $products->delete();
        if($result) {
            return response()->json(['message' => 'Delete product successfully']);
        } else {
            return response()->json(['message' => 'Update product fail']);
        };

    }
}
