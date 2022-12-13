<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryCollection;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
//code for swagger interpretation for displaying all categories
{
    /**
     *
     * @OA\Get(
     *     path="/api/categories",
     *     description="Displays all categories",
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
    //function to show all categories
    public function index()
    {
        return new CategoryCollection(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @OA\Post(
     *      path="/api/categories",
     *      operationId="storeCategory",
     *      tags={"Categories"},
     *      summary="Create a new Category",
     *      description="Stores the category in the database",
     *      security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"title", "description"},
     *            @OA\Property(property="title", type="string", format="string", example="Sample title"),
     *            @OA\Property(property="description", type="string", format="string", example="A quick description about this category")
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
     * @return \Illuminate\Http\CategoryResource
     */
    //function to store new categories if needed
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return new CategoryResource($category);
    }

//code for swagger interpretation for displaying categories by id

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
    //function to show categories by id
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @OA\Put(
     *      path="/api/categories/{id}",
     *      operationId="putCategory",
     *      tags={"Categories"},
     *      @OA\Parameter(
     *          name="id",
     *          description="Category id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer")
     *          ),
     *      summary="Update a category",
     *      description="Updates the category in the database",
     *      security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"title", "description"},
     *            @OA\Property(property="title", type="string", format="string", example="Sample title"),
     *            @OA\Property(property="description", type="string", format="string", example="A quick description about this category")
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    //function to update category if needed
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->all());

        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @OA\Delete(
     *    path="/api/categories/{id}",
     *    operationId="destroyCategory",
     *    tags={"Categories"},
     *    summary="Delete a Category",
     *    description="Delete Category",
     *      security={{"bearerAuth":{}}},
     *    @OA\Parameter(name="id", in="path", description="Id of a Category", required=true,
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    //function to delete a category by id if needed
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
