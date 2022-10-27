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

        if ($request->input('user_type') == 'Patient') {
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

            $token = $user->createToken('main')->plainTextToken;

            return response([
                'user' => $user,
                'token' => $token
            ]);
        } elseif ($request->input('user_type') == 'Doctor') {
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
                ],
                'academic_title' => 'required|string',
                'qualifications.main_qualification' => 'required|string',
                'qualifications.other_qualification' => 'required|string',
                'summary' => 'required|string',
                'specialty.main_specialty' => 'required',
                'specialty.sub_specialty' => 'required',
                'experience' => 'required|string',
                'instituition_id' => 'required|string',
            ]);

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
                'address' =>  $request->input('address'),
                'academic_title' => $data['academic_title'],
                'qualifications' =>  $request->input('qualifications'),
                'summary' => $data['summary'],
                'specialty' =>  $request->input('specialty'),
                'experience' => $data['experience'],
                'instituition_id' => $data['instituition_id'],
            ]);
        } elseif ($request->input('user_type') == 'Nurse') {
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
                ],
                'department' => 'required|string',
                'instituition_id' => 'required|string',
            ]);

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
                'address' =>  $request->input('address'),
                'department' => $data['department'],
                'instituition_id' => $data['instituition_id'],
            ]);
        } elseif ($request->input('user_type') == 'Medical Admin') {
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
                ],
                'instituition_id' => 'required|string',
            ]);

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
                'address' =>  $request->input('address'),
                'instituition_id' => $data['instituition_id'],
            ]);
        } elseif ($request->input('user_type') == 'Platform Admin' || 'Group Admin') {
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
        }


        return response([
            'user' => $user
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

    public function getUsers()
    {
        $users = User::all();

        return response([
            'users' => $users
        ]);
    }

    public function deleteUser(Request $request)
    {

        $user_id = $request->input('id');

        $user = User::destroy($user_id);

        return response([
            'success' => true,
            'res' => $user
        ]);
    }

    public function suspendUser(Request $request)
    {

        $user_id = $request->input('id');

        $user = User::where('id', $user_id)
            ->update(['suspended' => 1]);

        return response([
            'success' => true,
            'res' => $user
        ]);
    }
    public function unSuspendUser(Request $request)
    {

        $user_id = $request->input('id');

        $user = User::where('id', $user_id)
            ->update(['suspended' => 0]);

        return response([
            'success' => true,
            'res' => $user
        ]);
    }

    public function getUserById(Request $request)
    {
        $user_id = $request->input('id');
        $user = User::where('id', $user_id)->first();

        return response([
            'success' => true,
            'user' => $user
        ]);
    }

    public function updateUser(Request $request)
    {

        $user_id = $request->input('id');

        

        if ($request->input('user_type') == 'Patient') {

            // Clear user's unique field 
            $clear = User::where('id', $user_id)
            ->update([
                'email' => '',
                'phone_number' => '',
                'nric' => ''
            ]);

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
                'address.address' => 'required'
            ]);

            $user = User::where('id', $user_id)
            ->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'race' => $data['race'],
                'phone_number' => $data['phone_number'],
                'nric' => $data['nric'],
                'gender' => $data['gender'],
                'user_type' => $data['user_type'],
                'date_of_birth' => $data['date_of_birth'],
                'address' =>  $request->input('address')
            
            ]);

            return response([
                'user' => $user
            ]);

        } elseif ($request->input('user_type') == 'Doctor') {

            // Clear user's unique field 
            $clear = User::where('id', $user_id)
            ->update([
                'email' => '',
                'phone_number' => '',
                'nric' => ''
            ]);

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
                'academic_title' => 'required|string',
                'qualifications.main_qualification' => 'required|string',
                'qualifications.other_qualification' => 'required|string',
                'summary' => 'required|string',
                'specialty.main_specialty' => 'required',
                'specialty.sub_specialty' => 'required',
                'experience' => 'required|string',
                'instituition_id' => 'required',
            ]);

            $user = User::where('id', $user_id)
            ->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'race' => $data['race'],
                'phone_number' => $data['phone_number'],
                'nric' => $data['nric'],
                'gender' => $data['gender'],
                'user_type' => $data['user_type'],
                'date_of_birth' => $data['date_of_birth'],
                'address' =>  $request->input('address'),
                'academic_title' => $data['academic_title'],
                'qualifications' =>  $request->input('qualifications'),
                'summary' => $data['summary'],
                'specialty' =>  $request->input('specialty'),
                'experience' => $data['experience'],
                'instituition_id' => $data['instituition_id'],
            ]);


        } elseif ($request->input('user_type') == 'Nurse') {

            // Clear user's unique field 
            $clear = User::where('id', $user_id)
            ->update([
                'email' => '',
                'phone_number' => '',
                'nric' => ''
            ]);

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
                'department' => 'required|string',
                'instituition_id' => 'required',
            ]);

            $user = User::where('id', $user_id)
            ->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'race' => $data['race'],
                'phone_number' => $data['phone_number'],
                'nric' => $data['nric'],
                'gender' => $data['gender'],
                'user_type' => $data['user_type'],
                'date_of_birth' => $data['date_of_birth'],
                'address' =>  $request->input('address'),
                'department' => $data['department'],
                'instituition_id' => $data['instituition_id'],
            ]);
        } elseif ($request->input('user_type') == 'Medical Admin') {

            // Clear user's unique field 
            $clear = User::where('id', $user_id)
            ->update([
                'email' => '',
                'phone_number' => '',
                'nric' => ''
            ]);

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
                'instituition_id' => 'required',
            ]);

            $user = User::where('id', $user_id)
            ->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'race' => $data['race'],
                'phone_number' => $data['phone_number'],
                'nric' => $data['nric'],
                'gender' => $data['gender'],
                'user_type' => $data['user_type'],
                'date_of_birth' => $data['date_of_birth'],
                'address' =>  $request->input('address'),
                'instituition_id' => $data['instituition_id'],
            ]);
        } elseif ($request->input('user_type') == 'Platform Admin' || 'Group Admin') {

            // Clear user's unique field 
            $clear = User::where('id', $user_id)
            ->update([
                'email' => '',
                'phone_number' => '',
                'nric' => ''
            ]);

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
            ]);

            $user = User::where('id', $user_id)
            ->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'race' => $data['race'],
                'phone_number' => $data['phone_number'],
                'nric' => $data['nric'],
                'gender' => $data['gender'],
                'user_type' => $data['user_type'],
                'date_of_birth' => $data['date_of_birth'],
                'address' =>  $request->input('address')
            ]);
        }


        return response([
            'user' => $user
        ]);
    }
}
