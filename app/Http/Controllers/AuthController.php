<?php

/**
 * User: Zura
 * Date: 12/19/2021
 * Time: 3:49 PM
 */

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules;

/**
 * Class AuthController
 *
 * @author  Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|string|unique:users,email',
            'race' => 'required|string',
            'phone_number' => 'required|integer|unique:users,phone_number',
            'nric' => 'required|string|unique:users,nric',
            'gender' => 'required|string',
            'user_type' => 'required|string',
            'date_of_birth' => 'required|date',
            'address.postcode' => 'required|integer',
            'address.address' => 'required',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->mixedCase()->numbers()->symbols()
            ]
        ]);
        if ($data['user_type'] == 'patient') {
            /** @var \App\Models\User $user */
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'race' => $data['race'],
                'phone_number' => $data['phone_number'],
                'nric' => $data['nric'],
                'gender' => $data['gender'],
                'user_type' => $data['user_type'],
                'date_of_birth' => $data['date_of_birth'],
                'password' => bcrypt($data['password']),
                'address' =>  $request->input('address')
            ]);
        } else if ($data['user_type'] == 'nurse') {
            /** @var \App\Models\User $user */
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'race' => $data['race'],
                'phone_number' => $data['phone_number'],
                'nric' => $data['nric'],
                'gender' => $data['gender'],
                'user_type' => $data['user_type'],
                'date_of_birth' => $data['date_of_birth'],
                'password' => bcrypt($data['password']),
                'department' => $request->input('department')
            ]);
        }

        $token = $user->createToken('main')->plainTextToken;
        return response([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|string|exists:users,email',
            'password' => [
                'required',
            ],
            'remember' => 'boolean'
        ]);
        $remember = $credentials['remember'] ?? false;
        unset($credentials['remember']);

        if (!Auth::attempt($credentials, $remember)) {
            return response([
                'error' => 'The Provided credentials are not correct'
            ], 422);
        }
        $user = Auth::user();
        $token = $user->createToken('main')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token

        ]);
    }

    public function logout()
    {
        /** @var User $user */
        $user = Auth::user();
        // Revoke the token that was used to authenticate the current request...
        $user->currentAccessToken()->delete();

        return response([
            'success' => true
        ]);
    }
}
