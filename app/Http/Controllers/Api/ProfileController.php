<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller //nag base sa token wala sa user id
{
        /**
     * Update the image of the token bearer from resource.
     */
    public function image(UserRequest $request) //dapat na create ang account before update
    {
        $user = User::findOrFail($request->user()->id); //pangitaon ang user

        if (!is_null($user->image)){ //tan awon kong nay image daan 
            Storage::disk('public')->delete($user->image);
        }

        $user->image = $request->file('image')->storePublicly('images', 'public'); //kong naa delete aron ma update

        $user->save(); //save dayon niya 

        return $user;     
    }  
       /**
     * Display the specified the information of the token bearer.
     */
    public function show(Request $request)
    {
        return $request->user();   //pangitaon lang niya kong nag exist bah sya nga user
    }
}
