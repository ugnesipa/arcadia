<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;
use App\Http\Resources\PlantResource;
use App\Http\Resources\PlantCollection;
use Illuminate\Http\Response;

class PlantController extends Controller
{//code for swagger interpretation for displaying all plants
    /**
     * Display a listing of the resource.
     *
     * @OA\Get(
     *     path="/api/plants",
     *     description="Displays all plants",
     *     tags={"Plants"},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation, Returns a list of Plants in JSON format"
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
     *
     * @return \Illuminate\Http\Response
     */
    //function to show all plants
    public function index()
    {
        return new PlantCollection(Plant::all());
    }
//code for swagger interpretation for storing a new plant
    /**
     * Store a newly created resource in storage.
     *
     * @OA\Post(
     *      path="/api/plants",
     *      operationId="storePlant",
     *      tags={"Plants"},
     *      summary="Create a new Plant",
     *      description="Stores the plant in the DB",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name", "category", "origin", "climate", "mainenace_rating", "description"},
     *            @OA\Property(property="name", type="string", format="string", example="Sample Name"),
     *            @OA\Property(property="category", type="string", format="string", example="House Plant"),
     *            @OA\Property(property="origin", type="string", format="string", example="East Asia"),
     *            @OA\Property(property="climate", type="string", format="string", example="Temperate"),
     *            @OA\Property(property="maintenance_rating", type="integer", format="integer", example="1"),
     *            @OA\Property(property="description", type="string", format="string", example="A description about this lovely plant")
     *          )
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=""),
     *             @OA\Property(property="data",type="object")
     *          )
     *     )
     * )
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\PlantResource
     */
    //function to store new plant
    public function store(Request $request)
    {
        $plant = Plant::create($request->only([
            'name', 'category', 'origin', 'climate', 'maintenance_rating', 'description'
        ]));

        return new PlantResource($plant);
    }
//code for swagger interpretation for displaying a plant by id
    /**
     * Display the specified resource.
     *
     *@OA\Get(
     *     path="/api/plants/{id}",
     *     description="Gets a plant by ID",
     *     tags={"Plants"},
     *          @OA\Parameter(
     *          name="id",
     *          description="Plant id",
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
     * @param  \App\Models\Plant  $plant
     * @return \Illuminate\Http\PlantResource
     */
    //function to show plant by id
    public function show(Plant $plant)
    {
        return new PlantResource($plant);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plant  $plant
     * @return \Illuminate\Http\Response
     */
    //function to update plant by id
    public function update(Request $request, Plant $plant)
    {
        $plant->update($request->only([
            'name', 'category', 'origin', 'climate', 'maintenance_rating', 'description'
        ]));

        return new PlantResource($plant);
    }
//code for swagger interpretation for deleting a plant by id
    /**
     * Remove the specified resource from storage.
     *
     * @OA\Delete(
     *    path="/api/plants/{id}",
     *    operationId="destroyPlant",
     *    tags={"Plants"},
     *    summary="Delete a Plant",
     *    description="Delete Plant",
     *    @OA\Parameter(name="id", in="path", description="Id of a Plant", required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *         response=Response::HTTP_NO_CONTENT,
     *         description="Success",
     *         @OA\JsonContent(
     *         @OA\Property(property="status_code", type="integer", example="204"),
     *         @OA\Property(property="data",type="object")
     *          ),
     *       )
     *      )
     *  )
     *
     *
     * @param  \App\Models\Plant  $plant
     * @return \Illuminate\Http\Response
     */
    //function to delete plant by id
    public function destroy(Plant $plant)
    {
        $plant->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
