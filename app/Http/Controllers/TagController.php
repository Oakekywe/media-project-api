<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();

        return response()->json([
            'con' => true,
            'data' => $tags,
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

        $tag = Tag::create($request->all());

        return response()->json([
            'con' => true,
            'message' => 'Tag created successfully',
            'data' => $tag,
        ], Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $tag = Tag::find($id);

        if (!$tag) {
            return response()->json([
                'con' => false,
                'message' => 'tag not found',
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'con' => true,
            'data' => $tag,
        ], Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $tag = Tag::find($id);

        if (!$tag) {
            return response()->json([
                'con' => false,
                'message' => 'Tag not found',
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

        $tag->update($request->all());

        return response()->json([
            'con' => true,
            'message' => 'Tag updated successfully',
            'data' => $tag,
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $tag = Tag::find($id);

        if (!$tag) {
            return response()->json([
                'con' => false,
                'message' => 'Tag not found',
            ], Response::HTTP_NOT_FOUND);
        }

        $tag->delete();

        return response()->json([
            'con' => true,
            'message' => 'Tag deleted successfully',
        ], Response::HTTP_OK);
    }
}
