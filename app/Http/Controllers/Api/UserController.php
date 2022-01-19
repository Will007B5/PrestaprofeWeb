<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Aws\Sns\SnsClient;
use Aws\Exception\AwsException;

class UserController extends Controller{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return $this->userService->getAll();
    }
    public function show(User $user)
    {
        return $this->userService->getOne($user);
    }
    public function store(Request $request)
    {
        return $this->userService->create($request->all());
    }
    public function update(Request $request, User $user)
    {
        return $this->userService->update($request->all(), $user);
    }
    public function destroy(User $user)
    {
        return $this->userService->delete($user);
    }

    //For mobile app call only
    public function createClient(Request $request)
    {
        $data = $request->all();

        $rules = [
            'name' => 'required|string',
            'last_name' => 'required|string',
            'birth_date' => 'date_format:Y-m-d',
            'gender' => 'required|in:Hombre,Mujer',
            'civil_status' => 'required|in:Soltero/a,Casado/a,Divorciado/a,Separacion en proceso judicial,Viudo/a,Concubinato',
            'curp' => 'required|string|size:13',
            'address' => 'required|text',
            //'institution_id',
            'type',
            'salary_id' => 'required|exists:salaries,id',
            'phone' => 'required|size:10',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'rfc' => 'required|size:13',
            'ine' => 'image',
            'pay_stub' => 'image',
            'selfie' => 'image',
            'proof_address' => 'image',
            'first_reference_person_name' => 'required|string',
            'first_reference_person_phone' => 'required|string|size:13',
            'second_reference_person_name',
            'second_reference_person_phone',
            'city_id',
            'saving_bank_id',
            'job_id',
            'city_id',
        ];
    }

    //For mobile app call only
    public function getVerificationCode($phone)
    {
        $SnSclient = new SnsClient([
            //'profile' => 'default',
            'region' => 'us-east-2',
            'version' => '2010-03-31'
        ]);

        try {
            $code = $this->generateRandom(4);
            $result = $SnSclient->publish([
                'Message' => 'Este es tu código de verificación de Prestaprofe: #'.$code,
                'PhoneNumber' => '+52'.$phone,
            ]);

            return response(['verification_code' => $code],200);
        } catch (AwsException $e) {
            return response('No se pudo enviar el sms', 500);
        }
    }

    public function generateRandom($size)
    {
        $code = '';
        for ($i = 0; $i<$size; $i++)
        {
            $code .= mt_rand(0,9);
        }
        return $code;
    }
}
