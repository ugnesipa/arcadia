<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

//controls authorization, register and login in functionalities
class AuthController extends Controller
{
    //register function
    public function register(Request $request)
    {
        try {
            //validations for succesfull registering
            $validator = Validator::make($request->all(),
            [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]);

            //if registration fails
            if ($validator->fails()) {
                // create the JSON that will be returned in the response
                return response()->json(
                [
                    'status' => false,
                    'message' => 'validation error',
                    $validator->errors()
                ],
                // returns a response Unprocessable Entity.
                Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            // If you get this far, validation passed, so create the user in the database.
            $user = User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            // check out the table personal_access_tokens to see the generated tokens
            $token = $user->createToken('book-store-token')->plainTextToken;

            // create the successful response including the token
            return response()->json(
            [
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $token
            // HTTP_OK has the value 200 - success
            ], Response::HTTP_OK);
        }
    //if there is a server error that fails the registration
    catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //login function
    public function login(Request $request)
    {
        try {
            //log in validation requirements
            $validateUser = Validator::make($request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            //if validation fails
            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            //if email and password does not match
            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            //user variable from email
            $user = User::where('email', $request->email)->first();

            //return for successful registration
            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("book-store-token")->plainTextToken
            ], 200);

        }
        // If any other error is thrown it will be caught here
        catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    // This function returns the user profile, but only if they are logged in and have an authentication token
    public function user()
    {
        return response()->json(['user' => auth()->user()], Response::HTTP_OK);
    }

    //logs user out and deletes token
    public function logout(Request $request)
    {

        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Successfully logged out'], Response::HTTP_OK);
    }
}
