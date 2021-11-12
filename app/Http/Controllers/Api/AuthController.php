<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|in:Hombre,Mujer',
            'civil_status' => 'required|in:Soltero/a,Casado/a,Divorciado/a,Separacion en proceso judicial,Viudo/a,Concubinato',
            'curp' => 'string|size:13',
            'address' => 'required|max:255',
            'institution_id' => 'required|exists:institutions,id',
            'type' => 'required|string',
            'salary_id' => 'required|exists:salaries,id',
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:users'
        ]);
        if ($validator->fails())
        {
            return response($validator->errors(), 422);
        }
        $request['password']=Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        $user = User::create($request->toArray());
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $response = ['token' => $token];
        return response($response, 200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails())
        {
            return response($validator->errors(), 422);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                // $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $token = $user->createToken('Laravel Password Grant Client')->plainTextToken;
                $response = ['token' => $token];
                return response($response, 200);
            } else {
                $response = ["password" => "Contraseña incorrecta"];
                return response($response, 422);
            }
        } else {
            $response = ["email" =>'El email proporcionado no está asociado a un usuario registrado'];
            return response($response, 422);
        }
    }

    // method for user logout and delete token
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        $response = [

            'message' => "Has cerrado tu sesión existosamente"
        ];
        return response($response, 200);
    }
}
