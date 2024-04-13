<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if(request()->routeIs('users.login')) { //magamit rani sila tulo kanang sa ubos kong ang ihit nga route is users.store

            return [
                'email'       => 'required|string|email|max:255', //unique:App\Models\User,email ang kani sya para mag message nga nag exist natoh na email
                'password'    => 'required|min:8',
             ];
        }

        else if(request()->routeIs('users.store')) { //magamit rani sila tulo kanang sa ubos kong ang ihit nga route is users.store

            return [
                'firstname'        => 'required|max:255', //makita ni sya sa available validation rules laravel docu
                'lastname'         => 'required|string|max:255',
                'email'            => 'required|string|email|unique:App\Models\User,email|max:255', //unique:App\Models\User,email ang kani sya para mag message nga nag exist natoh na email
                'password'         => 'required|min:8|confirmed',
                'gender'           => 'required|max:255',
                'address'          => 'required|max:255',
                'birthdate'        => 'nullable|date',
             ];
        }
        else if(request()->routeIs('users.update')) {
            
            return [
                'name'        => 'required|string|max:255', //kay si name ramn atong need validate
             ];
        }
        else if(request()->routeIs('users.email')) {
            
            return [
                'email'       => 'required|email|max:255', 
             ];
        }
        else if(request()->routeIs('users.password')) {
            
            return [
                'password'    => 'required|confirmed|min:8',
             ];
        }
        else if(request()->routeIs('users.image')||request()->routeIs('profile.image')) {
            
            return [
                'image'       => 'required|image|mimes:jpg,bmp,png|max:2048',
             ];
        }
        else { return [];};
    }
}
