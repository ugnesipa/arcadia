<?php

namespace App\Http\Controllers;

use App\Models\Climate;
use Illuminate\Http\Request;
use App\Http\Resources\ClimateResource;
use App\Http\Resources\ClimateCollection;

class ClimateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ClimateCollection(Climate::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $climate = Climate::create($request->only([
            'title', 'description'
        ]));

        return new ClimateResource($climate);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Climate  $climate
     * @return \Illuminate\Http\Response
     */
    public function show(Climate $climate)
    {
        return new ClimateResource($climate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Climate  $climate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Climate $climate)
    {
        $climate->update($request->only([
            'title', 'description'
        ]));

        return new ClimateResource($climate);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Climate  $climate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Climate $climate)
    {
        //
    }
}
