<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryCollection;

class CategoryController extends Controller
{
    /**
     *
     *@OA\Get(
     *     path="/api/categories",
     *     description="Displays all the categories",
     *     tags={"Categories"},
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new CategoryCollection(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
    
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\CategoryResource
     */
    public function store(Request $request)
    {
        // $category = Category::create($request->only([
        //     'title', 'description'
        // ]));

        // return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     *
     * @OA\Get(
     *     path="/api/categories/{id}",
     *     description="Gets a category by ID",
     *     tags={"Categories"},
     *          @OA\Parameter(
     *          name="id",
     *          description="Category id",
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\CategoryResource
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // $category->update($request->only([
        //     'title', 'description'
        // ]));

        // return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     *

     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // $category->delete();
        // return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
