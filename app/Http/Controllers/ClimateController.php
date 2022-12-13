<?php

namespace App\Http\Controllers;

use App\Models\Climate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\ClimateResource;
use App\Http\Resources\ClimateCollection;
use App\Http\Requests\StoreClimateRequest;
use App\Http\Requests\UpdateClimateRequest;

class ClimateController extends Controller
{
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
    public function index()
    {
        return new ClimateCollection(Climate::paginate(1));
    }

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
    public function update(UpdateClimateRequest $request, Climate $climate)
    {
        $climate->update($request->all());
    }

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
    public function destroy(Climate $climate)
    {
        $climate->delete();

    }
}
