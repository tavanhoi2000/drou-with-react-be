<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Http\Resources\BlogResource;
use App\Http\Resources\BlogResourceCollection;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    public function index() {
        $blogs = Blog::orderBy('id','DESC')->get()->keyBy->id;
        return new BlogResourceCollection($blogs);
    }

    public function create(BlogRequest $request) {
        $blogs = new Blog();
        $request->validated();
        $blogs->title = $request->title;
        $blogs->description = $request->description;
        $blogs->sub_title = $request->sub_title;
        $blogs->sub_description = $request->sub_description; 
        $blogs->category_id = $request->category_id;
        $file_name = "";
        if($request->hasFile('image')) {
            $file_name = $request->file('image')->store('blogs', 'public');
        } else {
            $file_name = null;
        }
        $blogs->image = $file_name;
        $result = $blogs->save();
        if($result) {
            return response()->json(['message' => 'Create blog successfully']);
        } else {
            return response()->json(['message' => 'Create blog fail']);
        }
    }

    public function edit($id) {
        $blogs = Blog::findOrFail($id);
        return new BlogResource($blogs);
    }

    public function update(Request $request, $id) {
        $blogs = Blog::findOrFail($id);
        $destination = public_path("storage\\".$blogs->image);
        $file_name = "";
        if($request->hasFile('image')) {
            if(File::exists($destination)) {
                File::delete($destination);
            }
            $file_name = $request->file('image')->store('blogs', 'public');
        } else {
            $file_name = $request->image;
        }
        $blogs->title = $request->title;
        $blogs->description = $request->description;
        $blogs->sub_title = $request->sub_title;
        $blogs->sub_description = $request->sub_description;
        $blogs->image = $file_name;
        $result = $blogs->save();

        if($result) {
            return response()->json(['message' => 'Update blog successfully']);
        } else {
            return response()->json(['message' => 'Update blog fail']);
        }
    } 

    public function delete($id) {
        $blogs = Blog::findOrFail($id);
        $destination = public_path("storage\\".$blogs->image);
        if(File::exists($destination)) {
            File::delete($destination);
        }
        $result = $blogs->delete();
        if($result) {
            return response()->json(['message' => 'Delete blog successfully']);
        } else {
            return response()->json(['message' => 'Delete blog fail']);
        };

    }
}
