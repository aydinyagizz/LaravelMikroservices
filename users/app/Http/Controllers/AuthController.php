<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create(
            $request->only('first_name', 'last_name', 'email', 'is_admin')
            + [
                'password' => Hash::make($request->input('password'))
            ]
        );

        return response($user, Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response([
                'error' => 'invalid credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();

        $jwt = $user->createToken('token', [$request->input('scope')])->plainTextToken;

        //return compact('jwt');
        return ['jwt' => $jwt, 'user' => $user];
    }

    public function user(Request $request)
    {
        // Kullanıcı mevcut değilse 401 döndür
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $request->user();
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        //$request->user()->currentAccessToken()->delete();

        return response([
            'message' => 'success',
        ]);
    }

    public function updateInfo(Request $request)
    {
        $user = $request->user();

        $user->update($request->only('first_name', 'last_name', 'email'));

        return response($user, Response::HTTP_ACCEPTED);
    }

    public function updatePassword(Request $request)
    {
        $user = $request->user();

        $user->update([
            'password' => Hash::make($request->input('password'))
        ]);

        return response($user, Response::HTTP_ACCEPTED);
    }
}
