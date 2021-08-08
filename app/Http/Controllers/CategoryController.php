<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'success' => true,
            'message' => 'Successfully to load data.',
            'data' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:30'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Something wrong.',
                'data' => $validator->errors()
            ]);
        }

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        if ($category) {
            return response()->json([
                'success' => true,
                'message' => 'Successfully save category',
                'data' => $category
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'failed save category',
                'data' => $category
            ]);
        }
    }

    public function show($id)
    {
        $category = Category::find($id);

        return response()->json([
            'success' => true,
            'message' => 'Successfully to load data.',
            'data' => $category
        ]);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:30'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Something wrong.',
                'data' => $validator->errors()
            ]);
        }

        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();

        if ($category) {
            return response()->json([
                'success' => true,
                'message' => 'Successfully update category',
                'data' => $category
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Failed update category',
                'data' => $category
            ]);
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if (empty($category)) {
            return response()->json([
                'success' => false,
                'message' => 'Data category not found',
                'data' => null
            ], 404);
        }

        $category->delete();
        return response()->json([
            'success' => true,
            'message' => 'Successfully delete category',
            'data' => $category
        ], 200);
    }
}
