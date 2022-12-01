<?php

namespace App\Http\Controllers;

use App\Models\Climate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\ClimateResource;
use App\Http\Resources\ClimateCollection;

class ClimateController extends Controller

{ //code for swagger interpretation for displaying all climates
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
  //function to show all climates
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
     //function to store new climate if needed
    public function store(Request $request)
    {
        // $climate = Climate::create($request->only([
        //     'title', 'description'
        // ]));

        // return new ClimateResource($climate);
    }
//code for swagger interpretation for displaying climates by id
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
       //function to show categories by id
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
    //function to update climate if needed
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
    //function to delete a climate by id if needed
    public function destroy(Climate $climate)
    {
        // $climate->delete();
        // return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
