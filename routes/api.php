<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

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

Route::resource('institutions', 'Api\InstitutionController');
Route::resource('salaries', 'Api\SalaryController');

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('users', 'Api\UserController');
    Route::resource('roles', 'Api\RoleController');
    // API route for logout user
    Route::post('logout', [AuthController::class, 'logout']);
});
