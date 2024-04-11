<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
      /**
     * Login into specified resource.
     */
    public function login(UserRequest $request)
    {
     
        $user = User::where('email', $request->email)->first();
     
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
            $response = [
                'user'      =>  $user,
                'token'     =>  $user->createToken($request->email)->plainTextToken
            ];

     
        return $response;
    }



    public function logout()
    {
        return false;   //pangitaon lang niya kong nag exist bah sya nga user
    }
}
