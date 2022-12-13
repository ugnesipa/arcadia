<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\PlantResource;
use App\Http\Resources\PlantCollection;
use App\Http\Requests\StorePlantRequest;
use App\Http\Requests\UpdatePlantRequest;

class PlantController extends Controller
{ //code for swagger interpretation for displaying all plants
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
        return new PlantCollection(Plant::with('climate')
            ->with('categories')
            ->get());
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
     *      security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name", "category", "origin", "climate_id", "description"},
     *            @OA\Property(property="name", type="string", format="string", example="Sample Name"),
     *            @OA\Property(property="categories", type="integer", format="integer", example="[1, 2]"),
     *            @OA\Property(property="climate_id", type="integer", format="integer", example="3"),
     *            @OA\Property(property="origin", type="string", format="string", example="East Asia"),
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
    //function to store new plant with category array attached
    public function store(StorePlantRequest $request)
    {
        $plant = Plant::create($request->only([
            'name',
            'climate_id',
            'origin',
            'description'
        ]));

        $plant->categories()->attach($request->categories);

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

    //swagger interpretation for updating a plant
    /**
     * Update the specified resource in storage.
     *
     * @OA\Put(
     *      path="/api/plants/{id}",
     *      operationId="putPlant",
     *      tags={"Plants"},
     *      @OA\Parameter(
     *          name="id",
     *          description="Plant id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer")
     *          ),
     *      summary="Update a plant",
     *      description="Updates plants in the database",
     *      security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name", "categories", "climate_id", "origin", "description"},
     *            @OA\Property(property="name", type="string", format="string", example="Sample name"),
     *            @OA\Property(property="categories", type="integer", format="integer", example="[3, 5]"),
     *            @OA\Property(property="climate_id", type="integer", format="integer", example="8"),
     *            @OA\Property(property="origin", type="string", format="integer", example="East Asia"),
     *            @OA\Property(property="description", type="string", format="string", example="A long description about this lovely plant")
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plant  $plant
     * @return \Illuminate\Http\Response
     */
    //function to update plant by id with category
    public function update(UpdatePlantRequest $request, Plant $plant)
    {
        $plant->update($request->all());

        $plant->categories()->attach($request->categories);

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
     *    security={{"bearerAuth":{}}},
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
