<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Aws\Sns\SnsClient;
use Aws\Exception\AwsException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
            'birth_date' => 'required|date_format:Y-m-d',
            'gender' => 'required|in:Hombre,Mujer',
            'civil_status' => 'required|in:Soltero/a,Casado/a,Divorciado/a,Separacion en proceso judicial,Viudo/a,Concubinato',
            'curp' => 'required|string|size:18',
            'address' => 'required|string',
            //'institution_id',
            //'type',
            'salary_id' => 'required|exists:salaries,id',
            'phone' => 'required|size:10',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'rfc' => 'required|size:13',
            'ine' => 'required|mimes:pdf,jpg,jpeg,png',
            'ine_back' => 'required|mimes:pdf,jpg,jpeg,png',
            'pay_stub' => 'required|mimes:pdf,jpg,jpeg,png',
            'selfie' => 'required|image',
            'proof_address' => 'required|mimes:pdf,jpg,jpeg,png',
            'first_reference_person_name' => 'required|string',
            'first_reference_person_phone' => 'required|string|size:10',
            'second_reference_person_name' => 'required|string',
            'second_reference_person_phone' => 'required|string|size:10',
            'city_id' => 'required|exists:cities,id',
            'job_id' => 'required|exists:jobs,id',
        ];

        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response($validator->errors(), 422);
        }else{
            $data['type'] = 'Cliente';
            $data['ine'] = $request['ine']->store('clients');
            $data['ine_back'] = $request['ine_back']->store('clients');
            $data['pay_stub'] = $request['pay_stub']->store('clients');
            $data['selfie'] = $request['selfie']->store('clients');
            $data['proof_address'] = $request['proof_address']->store('clients');
            $data['password'] = bcrypt($data['password']);
            $client = User::create($data);
            return $client;
        }
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

    public function changeVerificationPhoneStatus(User $user)
    {
        $user->is_phone_verified = 1;
        $user->save();
        return response('Phone verification succesfull', 200);
    }

    public function getClients()
    {
        $users = User::select('id','name','last_name','is_admon_verified')->where('type','Cliente')->get();
        return response($users,200);
    }
    public function checkClients(Request $rq)
    {
        $data=$rq->all();

        $rules=[
            "clients"=>"required|array",
            "clients.*"=>"exists:users,id|min:1"
        ];

        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response($validator->errors(), 422);
        }else{
            User::whereIn('id',$data)->update(["is_admon_verified"=>1]);
            return response(["message"=>"Actualización exitosa"],200);
        }
    }

    public function changeStatusUser(User $user){
        $user->active=($user->active==1)?0:1;
        $user->save();
        return $user->active;
    }

    public function user(){
        return DB::table('users')->select('ro.name as role','users.id','users.name','users.last_name','users.email','users.active')
        ->join('model_has_roles as mhr', 'users.id','=','mhr.model_id')
        ->join('roles as ro','ro.id','=','mhr.role_id')
        ->where('users.id',auth()->user()->id)->first();
    }

    

}
