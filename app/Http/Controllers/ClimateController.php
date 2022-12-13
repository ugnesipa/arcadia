<?php

namespace App\Http\Controllers;

use App\Models\Climate;
use Illuminate\Http\Response;
use App\Http\Resources\ClimateResource;
use App\Http\Resources\ClimateCollection;
use App\Http\Requests\StoreClimateRequest;
use App\Http\Requests\UpdateClimateRequest;

class ClimateController extends Controller
{
    //swagger interpretation for displaying all climates
    /**
     * Display a listing of the resource.
     *
     * @OA\Get(
     *     path="/api/climates?page={page}",
     *     description="Displays all climates, page by page",
     *     tags={"Climates"},
     *     @OA\Parameter(
     *          name="page",
     *          description="page",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer")
     *          ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation, Returns a list of Categories in JSON format"
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

     //function to show all climates from climate collection and show them by pages
    public function index()
    {
        return new ClimateCollection(Climate::paginate(1));
    }

    //swagger interpretation to store a climate
    /**
     * Store a newly created resource in storage.
     *
     * @OA\Post(
     *      path="/api/climates",
     *      operationId="storeClimate",
     *      tags={"Climates"},
     *      summary="Create a new Climate",
     *      description="Stores the climate in the database",
     *      security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"title", "description"},
     *            @OA\Property(property="title", type="string", format="string", example="Sample title"),
     *            @OA\Property(property="description", type="string", format="string", example="A quick description about this climate")
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
     * @return \Illuminate\Http\Response
     */

     //function to store new climate - connects to StoreClimateRequest where i defined rules
    public function store(StoreClimateRequest $request)
    {
        $climate = Climate::create([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return new ClimateResource($climate);
    }

    //code for swagger interpretation for displaying climates by id
    /**
     * Display the specified resource.
     *
     * @OA\Get(
     *     path="/api/climates/{id}",
     *     description="Gets a climate by id",
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
     * @return \Illuminate\Http\Response
     */
    public function show(Climate $climate)
    {
        return new ClimateResource($climate);
    }

    //function to update climates by id
    /**
     * Update the specified resource in storage.
     *
     * @OA\Put(
     *      path="/api/climates/{id}",
     *      operationId="putClimate",
     *      tags={"Climates"},
     *      @OA\Parameter(
     *          name="id",
     *          description="Climate id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer")
     *          ),
     *      summary="Update a climate",
     *      description="Updates the climate in the database",
     *      security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"title", "description"},
     *            @OA\Property(property="title", type="string", format="string", example="Sample title"),
     *            @OA\Property(property="description", type="string", format="string", example="A quick description about this climate")
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
     * @param  \App\Models\Climate  $climate
     * @return \Illuminate\Http\Response
     */


     //function to update climate with UpdateClimateRequest where i defined rules
    public function update(UpdateClimateRequest $request, Climate $climate)
    {
        $climate->update($request->all());
        return new ClimateResource($climate);
    }

    //swagger interpretation for delete functionality
    /**
     * Remove the specified resource from storage.
     *
     * @OA\Delete(
     *    path="/api/climates/{id}",
     *    operationId="destroyClimate",
     *    tags={"Climates"},
     *    summary="Delete a Climate",
     *    description="Delete Climate",
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(name="id", in="path", description="Id of the Climate", required=true,
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
     * @param  \App\Models\Climate  $climate
     * @return Response
     */

     //function to delete a climate by id
     public function destroy(Climate $climate)
    {
        $climate->delete();

    }
}
