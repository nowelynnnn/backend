<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest; //import gikan sa request file
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash; //naggamit ug hash sa update

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all(); 
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated(); //

        $validated['password'] = Hash::make($validated['password']); //Security: Hashing transforms the plain text password into a fixed-size
                                                                     // string of characters that does not reveal the password, even if someone gains access to the stored hash.
        $user = User::create($validated);

        return $user;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return User::findOrFail($id);   //pangitaon lang niya kong nag exist bah sya nga user
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $user = User::findOrFail($id); //pangitaon

        $validated = $request->validated(); //validate kong naa bah jud
 
        $user->name = $validated ['name']; //kay mao naa sa table pwede add ka sa table ug firstname, lastname, fullname
                                            // set ang new updated name
        $user->save(); //save dayon niya 

        return $user;   //balik pakita sa user
    }


    /**
     * Update the email of the specified resource in storage.
     */
    public function email(UserRequest $request, string $id)
    {
        $user = User::findOrFail($id); //pangitaon

        $validated = $request->validated(); //validate kong naa bah jud
 
        $user->email = $validated ['email']; 

        $user->save(); //save dayon niya 

        return $user;
    }


    /**
     * Update the password to the specified resource in storage.
     */
    public function password(UserRequest $request, string $id)
    {
        $user = User::findOrFail($id); //pangitaon

        $validated = $request->validated(); //validate kong naa bah jud
 
        $user->password = $validated ['password']; 

        $user->save(); //save dayon niya 

        return $user;
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $User = User::findOrFail($id);  //pangitaon niya ang user kong naa bah  
 
        $User->delete();        //kong naa iyang execute aron ma delete na (soft delete rani sya)

        return $User;       
    }   
}
