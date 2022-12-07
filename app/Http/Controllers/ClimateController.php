<?php

namespace App\Http\Controllers;

use App\Models\Climate;
use Illuminate\Http\Request;
use App\Http\Resources\ClimateResource;
use App\Http\Resources\ClimateCollection;
use App\Http\Requests\StoreClimateRequest;
use App\Http\Requests\UpdateClimateRequest;

class ClimateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ClimateCollection(Climate::paginate(1));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClimateRequest $request)
    {
        $climate = Climate::create([
            'title' => $request->title,
            'description' => $request->description
        ]);

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
    public function update(UpdateClimateRequest $request, Climate $climate)
    {
        $climate->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Climate  $climate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Climate $climate)
    {
        $climate->delete();
    }
}
