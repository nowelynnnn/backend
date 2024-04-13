<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
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
     
        $user = User::where('email', $request->email)->first(); //validate pa ang email ug password kong nag exist bah sa tableplus
     
        if (! $user || ! Hash::check($request->password, $user->password)) { //Guard Clause, Compare niya ang password sa encrypted
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
            $response = [
                'user'      =>  $user,
                'token'     =>  $user->createToken($request->email)->plainTextToken //komg sakto kani na dayon mo gawas
            ];

     
        return $response;
    }



    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        $response = [
            'message' => 'Logout.'
        ];
        return $response;   //pangitaon lang niya kong nag exist bah sya nga user
    }
}
