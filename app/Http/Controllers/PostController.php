<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // public function index()
    // {
    //     $posts = Post::latest('updated_at')->paginate(12);

    //     return response()->json([
    //         'con' => true,
    //         'data' => $posts,
    //     ], Response::HTTP_OK);
    // }

    public function paginate($page)
    {
        $posts = Post::latest('updated_at')->paginate(12, ['*'], 'page', $page);

        return response()->json([
            'con' => true,
            'data' => $posts,
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $rules = [
            'category_id' => 'required',
            'tag_id' => 'required',
            'user_id' => 'required',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'con' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], Response::HTTP_BAD_REQUEST);
        }

        $post = Post::create($request->all());

        return response()->json([
            'con' => true,
            'message' => 'Post created successfully',
            'data' => $post,
        ], Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'con' => false,
                'message' => 'Post not found',
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'con' => true,
            'data' => $post,
        ], Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'con' => false,
                'message' => 'Post not found',
            ], Response::HTTP_NOT_FOUND);
        }

        $rules = [
            'category_id' => 'required',
            'tag_id' => 'required',
            'user_id' => 'required',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'con' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], Response::HTTP_BAD_REQUEST);
        }

        $post->update($request->all());

        return response()->json([
            'con' => true,
            'message' => 'Post updated successfully',
            'data' => $post,
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'con' => false,
                'message' => 'Post not found',
            ], Response::HTTP_NOT_FOUND);
        }

        $post->delete();

        return response()->json([
            'con' => true,
            'message' => 'Post deleted successfully',
        ], Response::HTTP_OK);
    }

    public function filterByTag(Request $request, $tagId)
    {
        $posts = Post::select("id", "title", "content", "image")
            ->where("tag_id", $tagId)
            ->latest('created_at')
            ->paginate(6);
        // $posts = DB::select('SELECT * FROM posts WHERE tag_id = ?', [$tagId]);
        if ($posts->isEmpty()) {
            return response()->json([
                'con' => false,
                'message' => 'Posts not found',
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'con' => true,
            'message' => "posts by tag",
            'data' => $posts,
        ], Response::HTTP_OK);
    }

    public function filterByCat(Request $request, $catId)
    {
        $posts = Post::select("id", "title", "content", "image", "category_id")
            ->with(['category' => function ($query) {
                $query->select('id', 'name');
            }])
            ->where("category_id", $catId)
            ->latest('created_at')
            ->paginate(6);
        if ($posts->isEmpty()) {
            return response()->json([
                'con' => false,
                'message' => 'Posts not found',
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'con' => true,
            'message' => "posts by cat",
            'data' => $posts,
        ], Response::HTTP_OK);
    }
}
