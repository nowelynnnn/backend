<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\CarouselItems;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarouselItemsRequest;
use Illuminate\Auth\Events\Validated;

class CarouselItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CarouselItems::all(); 
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CarouselItemsRequest $request)
    {
         // Retrieve the validated input data...
        $validated = $request->validated();
        $CarouselItem = CarouselItems::create($validated);

        return $CarouselItem;
    } 

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return CarouselItems::findOrFail($id);

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $CarouselItem = CarouselItems::findOrFail($id);
 
        $CarouselItem->delete();

        return $CarouselItem;
    }
}
