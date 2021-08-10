<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category')->get();
        
        return response()->json([
            'success' => true,
            'message' => 'Successfully to load data.',
            'data' => $blogs
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer|exists:categories,id',
            'title' => 'required|string|min:3|max:200',
            'description' => 'required|string|min:3',
            'content' => 'required'
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'success' => false,
                'message' => 'Something wrong.',
                'data' => $validator->errors()
            ]);
        }

        $blog = new Blog();
        $blog->category_id = $request->category_id;
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->content = $request->content;
        $blog->save();

        if ($blog) {
            return response()->json([
                'success' => true,
                'message' => 'Successfully save blog',
                'data' => $blog
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed save blog',
                'data' => null
            ]);
        }
    }

    public function show($id)
    {
        $blog = Blog::with('category')->where('id', $id)->first();
        
        return response()->json([
            'success' => true,
            'message' => 'Successfully to load data.',
            'data' => $blog
        ]);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer|exists:categories,id',
            'title' => 'required|string|min:3|max:200',
            'description' => 'required|string|min:3',
            'content' => 'required'
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'success' => false,
                'message' => 'Something wrong.',
                'data' => $validator->errors()
            ]);
        }

        $blog = Blog::find($id);
        $blog->category_id = $request->category_id;
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->content = $request->content;
        $blog->save();

        if ($blog) {
            return response()->json([
                'success' => true,
                'message' => 'Successfully update blog',
                'data' => $blog
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed update blog',
                'data' => $blog
            ]);
        }
    }

    public function destroy($id)
    {
        $blog = Blog::find($id);
        if (empty($blog)) {
            return response()->json([
                'success' => false,
                'message' => 'Data blog not found',
                'data' => null
            ]);
        }

        $blog->delete();
        return response()->json([
            'success' => true,
            'message' => 'Successfully delete blog',
            'data' => $blog
        ]);
    }
}
