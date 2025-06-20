<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     * tags={"Authentition"},
     * path="/api/auth/login",
     * summary="Login with account",
     * description="Input your email and password to get token login.",
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * type="object",
     * required={"name", "password", "device_name"},
     * @OA\Property(property="email", type="string", example="youremail@mail.com"),
     * @OA\Property(property="password", type="string", example="yourpassword"),
     * @OA\Property(property="device_name", type="string", enum={"web", "mobile", "desktop"}, example="web"),
     * )
     * ),
     * @OA\Response(
     * response=200,
     * description="User Logged in successfully",
     * @OA\JsonContent(
     * @OA\Property(property="status", type="string", example="success"),
     * @OA\Property(property="message", type="string", example="User Logged in successfully"),
     * @OA\Property(property="data", type="object",
     * 
     * @OA\Property(property="user", type="object",
     * @OA\Property(property="id", type="integer",  example="1" ),
     * @OA\Property(property="name", type="string", example="admin"),
     * @OA\Property(property="email", type="string", example="admin@gamil.com" ),
     * @OA\Property(property="email_verified_at", type="string",format="date-time" ),
     * @OA\Property(property="created_at", type="string",format="date-time" ),
     * @OA\Property(property="updated_at",  type="string",format="date-time" ),
     * ),
     * 
     * @OA\Property(property="token", type="string", example="8|ciQFmsF0mMeODUY7WXfPfwj3EsT5BjnlmTzh2QGQ35768350" )
     * )
     * )
     * ),
     * @OA\Response(
     * response=401 ,
     * description="Error: Unauthorized",
     * @OA\JsonContent(
     * @OA\Property(property="status", type="string", example="error"),
     * @OA\Property(property="message", type="string", example="Invalid Credentials"),
     * )
     * ),
     * @OA\Response(
     * response=422,
     * description="Unprocessable Entity - Validation failed for the provided data.",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string", example="The given data was invalid."),
     * @OA\Property(property="data", type="object",
     * @OA\Property(property="email", type="array", @OA\Items(type="string", example="The email field is required.")),
     * @OA\Property(property="password", type="array", @OA\Items(type="string", example="The password field is required.")),
     * @OA\Property(property="device_name", type="array", @OA\Items(type="string", example="The selected device_name is invalid."))
     * )
     * )
     * )
     * )
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            // throw ValidationException::withMessages([
            //     'email' => ['The provided credentials are incorrect.'],
            // ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Credentials',
            ], 401);
        }

        $token = $user->createToken($request->device_name)->plainTextToken;
        return response()->json([
            'status' => 'success',
            'message' => 'User Logged in successfully',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ], 200);
    }
}
