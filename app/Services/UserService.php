<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\User;

class UserService {

    protected $userRepository;
    protected $user;

    public function __construct(UserRepository $userRepository, User $user)
    {
        $this->userRepository = $userRepository;
        $this->user=$user;
    }

    public function getAll()
    {
        return $this->userRepository->getAll();
    }

    public function getOne($user)
    {
        return $this->userRepository->getOne($user);
    }

    public function create($data)
    {
        $rules =[
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|exists:roles,name'
            /*'birth_date' => 'required|date',
            'gender' => 'required|in:Hombre,Mujer',
            'civil_status' => 'required|in:Soltero/a,Casado/a,Divorciado/a,Separacion en proceso judicial,Viudo/a,Concubinato',
            'curp' => 'string|size:13',
            'address' => 'required|max:255',
            'institution_id' => 'required|exists:institutions,id',
            'type' => 'required|string',
            'salary_id' => 'required|exists:salaries,id',
            'phone' => 'required|string|max:15',*/
        ];

        $validator= Validator::make($data,$rules);

        if($validator->fails()){

            return response($validator->errors(),422);

        }else{
            $pass = $this->make_password();

            $data['password'] = Hash::make($pass);

            $user = $this->user->make($data);
            //dd($user);
            $user->assignRole($data['role']);

            // Mail::to($user->email)->send(new UserSaved($user));
            $user->password = bcrypt($user->password);

            $user->save();
            //$user->roles()->sync($request->get('roleIds'));

            return $this->userRepository->create($data);
        }
    }

    public function update($data, $user)
    {
        $rules =[
            'name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'birth_date' => 'date',
            'gender' => 'in:Hombre,Mujer',
            'civil_status' => 'in:Soltero/a,Casado/a,Divorciado/a,Separacion en proceso judicial,Viudo/a,Concubinato',
            'curp' => 'size:13',
            'address' => 'max:255',
            'institution_id' => 'exists:institutions,id',
            'type' => 'string',
            'salary_id' => 'exists:salaries,id',
            'phone' => 'string|max:15',
            'email' => 'string|email|max:255|unique:users',
            'role' => 'exists:roles,name'
        ];

        $validator= Validator::make($data,$rules);

        if($validator->fails()){

            return response($validator->errors(),422);

        }else{
            if ($this->userRepository->update($data, $user)) {
                return $user;
            }
            else{

            }
        }
    }

    public function delete($user)
    {
        return $this->userRepository->delete($user);
    }

    public function make_password()
    {
        return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8);
    }
}
