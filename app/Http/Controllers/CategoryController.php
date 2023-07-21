<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();

        return response()->json([
            'con' => true,
            'data' => $categories,
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'con' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], Response::HTTP_BAD_REQUEST);
        }

        $category = Category::create($request->all());

        return response()->json([
            'con' => true,
            'message' => 'Category created successfully',
            'data' => $category,
        ], Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'con' => false,
                'message' => 'Category not found',
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'con' => true,
            'data' => $category,
        ], Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'con' => false,
                'message' => 'Category not found',
            ], Response::HTTP_NOT_FOUND);
        }

        $rules = [
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'con' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], Response::HTTP_BAD_REQUEST);
        }

        $category->update($request->all());

        return response()->json([
            'con' => true,
            'message' => 'Category updated successfully',
            'data' => $category,
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'con' => false,
                'message' => 'Category not found',
            ], Response::HTTP_NOT_FOUND);
        }

        $category->delete();

        return response()->json([
            'con' => true,
            'message' => 'Category deleted successfully',
        ], Response::HTTP_OK);
    }
}
