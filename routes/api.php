<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SurveyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::resource('/survey', \App\Http\Controllers\SurveyController::class);

    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index']);
    Route::get('/patient-dashboard', [\App\Http\Controllers\PatientDashboardController::class, 'index']);

    
    
});
//Materials
Route::post('/material/create',[\App\Http\Controllers\MaterialController::class,'createMaterial']);
Route::get('/material/get',[\App\Http\Controllers\MaterialController::class,'getMaterial']);
Route::post('/material/delete',[\App\Http\Controllers\MaterialController::class,'deleteMaterial']);
Route::post('/material/update',[\App\Http\Controllers\MaterialController::class,'updateMaterial']);

//Institutes
Route::post('/institute/create',[\App\Http\Controllers\InstituitionController::class,'createInstituition']);
Route::get('/institute/get',[\App\Http\Controllers\InstituitionController::class,'getInstituition']);
Route::post('/institute/delete',[\App\Http\Controllers\InstituitionController::class,'deleteInstitute']);
Route::post('/institute/update',[\App\Http\Controllers\InstituitionController::class,'updateInstitute']);
Route::post('/institute/getAdmin',[\App\Http\Controllers\InstituitionController::class,'adminGetInstituition']);

//For Slots
Route::post('/institute/generateSlots',[\App\Http\Controllers\SlotController::class,'createSlots']);
//Specialty
Route::post('/specialty/create',[\App\Http\Controllers\SpecialtyController::class,'createSpecialty']);
Route::get('/specialty/get',[\App\Http\Controllers\SpecialtyController::class,'getSpecialty']);
Route::post('/specialty/delete',[\App\Http\Controllers\SpecialtyController::class,'deleteSpecialty']);
Route::post('/specialty/update',[\App\Http\Controllers\SpecialtyController::class,'updateSpecialty']);

//For Group Admin Manage Account
Route::post('/users/getAll',[\App\Http\Controllers\AuthController::class,'getUsers']);
Route::post('/users/deleteUser',[\App\Http\Controllers\AuthController::class,'deleteUser']);
Route::post('/users/suspendUser',[\App\Http\Controllers\AuthController::class,'suspendUser']);
Route::post('/users/unSuspendUser',[\App\Http\Controllers\AuthController::class,'unSuspendUser']);
Route::post('/users/updateUser',[\App\Http\Controllers\AuthController::class,'updateUser']);

//For organization Table
Route::post('/org/get',[\App\Http\Controllers\OrganizationController::class,'getOrg']);

//For appointmet Table 
Route::post('/appointment/create',[\App\Http\Controllers\AppointmentController::class,'createAppointment']);
Route::post('/appointment/getDoctor',[\App\Http\Controllers\AppointmentController::class,'getApointmentsForDoctor']);
Route::post('/appointment/patientGetAppointments',[\App\Http\Controllers\AppointmentController::class,'patientGetAppointments']);
Route::post('/appointment/doctorGetAppointments',[\App\Http\Controllers\AppointmentController::class,'doctorGetAppointments']);
Route::post('/appointment/getAppointmentById',[\App\Http\Controllers\AppointmentController::class,'getAppointmentById']);
Route::post('/appointment/nurseGetAppointments',[\App\Http\Controllers\AppointmentController::class,'nurseGetAppointments']);
Route::post('/appointment/update-appointment',[\App\Http\Controllers\AppointmentController::class,'updateAppointment']);
Route::post('/appointment/delete',[\App\Http\Controllers\AppointmentController::class,'deleteAppointment']);


//For Patient making appointment page 
Route::post('/patient/getDoctorsFromInstitute', [AuthController::class, 'getDoctorsFromInstitute']);
Route::get('/patient/getDoctors', [AuthController::class, 'getAllDoctors']);
Route::post('/patient/getDoctorAvailability', [AppointmentController::class, 'patientGetDoctorAvailability']);
Route::post('/patient/getDoctorsFromSpecialty', [AuthController::class, 'getDoctorsFromSpecialty']);

//For Doctor page
Route::get('/doctor/getPatients', [AuthController::class, 'getAllPatients']);
Route::get('/survey-by-slug/{survey:slug}', [\App\Http\Controllers\SurveyController::class, 'showForGuest']);
Route::post('/survey/{survey}/answer', [\App\Http\Controllers\SurveyController::class, 'storeAnswer']);

//For Nurse page 
Route::post('/nurse/getDoctors', [AuthController::class, 'getAllDoctorsFromInstitute']);

//For Medical Admin
Route::post('/saveImages', [SurveyController::class, 'saveImage']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/registerGroupAdmin', [AuthController::class, 'registerGroupAdmin']);
Route::post('/login', [AuthController::class, 'login']);

