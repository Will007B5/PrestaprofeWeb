<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Models\User;
use App\Http\Controllers\Api\StateController;
use App\Http\Controllers\Api\UserController;
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
Route::post('create-client','Api\UserController@createClient');
Route::get('change-verification-phone-status/{user}','Api\UserController@changeVerificationPhoneStatus');

//CARDS

Route::resource('cards', 'CardController');
Route::get('my-cards/{user}','CardController@myCards');


//LOANS
Route::resource('loans', 'LoanController');



Route::post('importaEstados', [StateController::class, 'importStates']);
Route::resource('users', 'Api\UserController');
//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::resource('roles', 'Api\RoleController');
    // API route for logout user
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::get('getClients','Api\UserController@getClients');
Route::post('checkClients','Api\UserController@checkClients');