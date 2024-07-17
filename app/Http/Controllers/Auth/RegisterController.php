<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    use HasApiTokens;

     /**
     * Handle user registration.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'avatar' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,avif', 'max:2048'],
        ]);

        if ($validator->fails()) {
            // Return validation errors
            return response()->json($validator->errors(), 422);
        }

        $avatar = '';

        // Check if the request has a file with the name 'avatar'
        if (request()->hasFile('avatar')) {

            $avatar = url('/storage/' . request()->file('avatar')->store('profiles', 'public'));

        }
        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $avatar,
        ]);

        // Generate token
        $token = $user->createToken('Personal Access Token')->accessToken;

        // Return response
        return response()->json([
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
            ],
            'token' => $token,
        ], 201);

    }
}
