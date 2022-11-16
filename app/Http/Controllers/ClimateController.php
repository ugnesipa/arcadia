<?php

namespace App\Http\Controllers;

use App\Models\Climate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\ClimateResource;
use App\Http\Resources\ClimateCollection;

class ClimateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @OA\Get(
     *     path="/api/climates",
     *     description="Displays all the climates",
     *     tags={"Climates"},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation, Returns a list of Climates in JSON format"
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
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

     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\ClimateResource
     */
    public function store(Request $request)
    {
        // $climate = Climate::create($request->only([
        //     'title', 'description'
        // ]));

        // return new ClimateResource($climate);
    }

    /**
     * Display the specified resource.
     *
     *@OA\Get(
     *     path="/api/climates/{id}",
     *     description="Gets a climate by ID",
     *     tags={"Climates"},
     *          @OA\Parameter(
     *          name="id",
     *          description="Climate id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer")
     *          ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     *
     * @param  \App\Models\Climate  $climate
     * @return \Illuminate\Http\ClimateResource
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
        // $climate->update($request->only([
        //     'title', 'description'
        // ]));

        // return new ClimateResource($climate);
    }

    /**
     * Remove the specified resource from storage.
     *
    

     *
     * @param  \App\Models\Climate  $climate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Climate $climate)
    {
        // $climate->delete();
        // return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
