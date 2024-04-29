<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //membuat login 
    public function login (Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            /** @var \App\Models\MyUserModel $user */
        $user = Auth::user();
        $token = $user->createToken('token-name',['server:update'])->plainTextToken;
        
        //cek data
        // dd($user);
        
        return response()->json([
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'company' => $user->company_id,
                'role' => $user->role,
                'department' => $user->deparment,
                'photo' => $user->photo,
                'status' => $user->status,
                'token' => $token,
            ]
        ]);
            
        }

        return response()->json([
            "message" => "Wrong email or passwrord"
          ], 401);

    }

    public function logout (Request $request) {
        $token = $request->bearerToken();

        if ($token) {
            $user = Auth::user();

            //hapus token yang sesuai demgam token yang diberikan 
            $user->tokens()->where('token', hash('sha256', $token))->delete(); 

            return response()->json([
                'message' => 'Succefully logged out'
            ]);

            return response()->json([
                'message' => 'Token is required'
            ], 400);
        }
    }
}
