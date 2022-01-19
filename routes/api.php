<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Models\User;
use App\Http\Controllers\Api\StateController;
use Illuminate\Support\Facades\Hash;

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
//API route for register new user
Route::post('register', [AuthController::class, 'register']);
//API route for login user
Route::post('login', [AuthController::class, 'login']);

Route::post('mobilelogin', [AuthController::class, 'mobilelogin']);

Route::resource('institutions', 'Api\InstitutionController');
Route::resource('salaries', 'Api\SalaryController');
Route::resource('states', 'Api\StateController');
Route::resource('municipalities', 'Api\MunicipalityController');
Route::get('state_municipalities/{state}','Api\MunicipalityController@municipalitiesByState');
Route::resource('cities', 'Api\CityController');
Route::get('municipality_cities/{municipality}','Api\CityController@citiesByMunicipality');
Route::post('import_institutions','Api\InstitutionController@importInstitutions');

Route::resource('jobs', 'JobController');
Route::get('get-verification-code/{phone}','Api\UserController@getVerificationCode');


Route::post('importaEstados', [StateController::class, 'importStates']);

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('users', 'Api\UserController');
    Route::resource('roles', 'Api\RoleController');
    // API route for logout user
    Route::post('logout', [AuthController::class, 'logout']);
});
