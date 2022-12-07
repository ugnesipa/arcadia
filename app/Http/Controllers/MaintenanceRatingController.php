<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaintenanceRating;
use App\Http\Resources\MaintenanceRatingResource;
use App\Http\Resources\MaintenanceRatingCollection;

class MaintenanceRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @OA\Get(
     *     path="/api/maintenance_ratings",
     *     description="Displays all the Maintenace Rating",
     *     tags={"MaintenanceRating"},
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

    //function to show all maintenance ratings
    public function index()
    {
        return new MaintenanceRatingCollection(MaintenanceRating::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @OA\Get(
     *     path="/api/maintenance_ratings/{id}",
     *     description="Gets a maintenance rating by ID",
     *     tags={"MaintenanceRating"},
     *          @OA\Parameter(
     *          name="id",
     *          description="Maintenance rating id",
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
     * @param  \App\Models\MaintenanceRating  $maintenanceRating
     * @return \Illuminate\Http\Response
     */
    //function to show maintenance ratings by id
    public function show(MaintenanceRating $maintenanceRating)
    {
        return new MaintenanceRatingResource($maintenanceRating);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MaintenanceRating  $maintenanceRating
     * @return \Illuminate\Http\Response
     */

    //function to update maintenance rating if needed
    public function update(Request $request, MaintenanceRating $maintenanceRating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MaintenanceRating  $maintenanceRating
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaintenanceRating $maintenanceRating)
    {
        //
    }
}
