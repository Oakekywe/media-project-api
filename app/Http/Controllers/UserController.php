<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json([
            'con' => true,
            'data' => $users,
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        // $user = User::create($request->all());
        // return response()->json($user, 201);

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6',
            'phone' => 'required|unique:users,phone'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'con' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], Response::HTTP_BAD_REQUEST);
        }

        $user = User::create($request->all());

        return response()->json([
            'con' => true,
            'message' => 'User created successfully',
            'data' => $user,
        ], Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'con' => false,
                'message' => 'User not found',
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'con' => true,
            'data' => $user,
        ], Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'con' => false,
                'message' => 'User not found',
            ], Response::HTTP_NOT_FOUND);
        }

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:6', // "sometimes" means only validate if present
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'con' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], Response::HTTP_BAD_REQUEST);
        }

        $user->update($request->all());

        return response()->json([
            'con' => true,
            'message' => 'User updated successfully',
            'data' => $user,
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'con' => false,
                'message' => 'User not found',
            ], Response::HTTP_NOT_FOUND);
        }

        $user->delete();

        return response()->json([
            'con' => true,
            'message' => 'User deleted successfully',
        ], Response::HTTP_OK);
    }
}
