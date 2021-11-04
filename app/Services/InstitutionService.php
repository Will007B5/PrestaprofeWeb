<?php

namespace App\Services;

use App\Repositories\InstitutionRepository;
use Illuminate\Support\Facades\Validator;

class InstitutionService {

    protected $institutionRepository;

    public function __construct(InstitutionRepository $institutionRepository)
    {
        $this->institutionRepository = $institutionRepository;
    }

    public function getAll()
    {
        return $this->institutionRepository->getAll();
    }

    public function getOne($institution)
    {
        return $this->institutionRepository->getOne($institution);
    }

    public function create($data)
    {
        $rules =[
            'name' => 'required|string|max:255',
        ];

        $validator= Validator::make($data,$rules);

        if($validator->fails()){

            return response($validator->errors(),422);

        }else{
            return $this->institutionRepository->create($data);
        }
    }

    public function update($data, $institution)
    {
        $rules =[
            'name' => 'string|max:255',
        ];

        $validator= Validator::make($data,$rules);

        if($validator->fails()){
            return response($validator->errors(),422);
        }
        else{
            if ($this->institutionRepository->update($data, $institution)) {
                return $institution;
            }
            else{

            }
        }
    }

    public function delete($institution)
    {
        return $this->institutionRepository->delete($institution);
    }
}
