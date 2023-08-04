<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class loginController extends Controller
{
    // public function register(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required',
    //         'email' => 'required|email',
    //         'password' => 'required',
    //         'c_password' => 'required|same:password',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['message' => 'Validation error'], 422);
    //     }

    //     $data = $request->only(['name', 'email', 'password']);
    //     $data['password'] = Hash::make($data['password']);

    //     $user = User::create($data);

    //     $token = $user->createToken('MyApp')->plainTextToken;

    //     $response = [
    //         'token' => $token,
    //         'name' => $user->name,
    //     ];

    //     return response()->json($response, 200);
    // }

    // public function login(Request $request)
    // {
    //     if (Auth::attempt([
    //         'email' => $request->input('email'),
    //         'password' => $request->input('password')
    //     ])) {
    //         $user = Auth::user();
    //         $response['token'] = $user->createToken('myapp');
    //         $response['name'] = $user->name;
    //         return response()->json($response, 200);
    //     } else {
    //         return response()->json(['massage' => 'invalid credentials error'], 400);
    //     }
    // }
}
