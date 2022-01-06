<?php

namespace App\Services;

use App\Models\City;
use App\Models\Institution;
use App\Repositories\InstitutionRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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

    public function importInstitutions($file)
    {
        $inputFileName = $file->getPathname();
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(true);
        $worksheet = $reader->load($inputFileName);

        $activeSheet = $worksheet->getActiveSheet();

        $iterator = $activeSheet->toArray(NULL, FALSE, FALSE, FALSE);
        for ($i=1; $i < sizeof($iterator); $i++) {
            $cityName  = $iterator[$i][0];
            $city = DB::select("select * from cities where name like _utf8'%".$cityName."%'");
            Institution::firstOrCreate(
              ['clave' => $iterator[$i][1]] ,
              [
                'name' => $iterator[$i][2],
                'address' => $iterator[$i][3],
                'email' => $iterator[$i][6],
                'phone' =>$iterator[$i][5],
                'clave' => $iterator[$i][1],
                'city_id' => empty($city[0])? 26: $city[0]->id,
              ]
            );
        }


    }
}
