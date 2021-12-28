<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Municipality;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function importStates(Request $request)
    {
        // $data = $request->all();
        // $file = $data['file'];
        ini_set('memory_limit','999999M');
        ini_set('max_execution_time', 7200);
        ini_set('request_terminate_timeout', 7200);
        // // if($type == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'){
        // //     $inputFileType = 'Xlsx';
        // // }else{
        // //     $inputFileType = 'Xls';
        // // }
        // //dd($file->getRealPath());
        // dd($file);
        // $inputFileName = $file->getRealPath().$file->getClientOriginalName();
        //dd($inputFileName);
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xls');
        $reader->setReadFilter( new MyReadFilter());
        $reader->setReadDataOnly(true);
        $worksheetNames = $reader->listWorksheetNames('C:\Users\guill\Desktop\Prestaprofe APP\#CAPTURAS\CPdescargav0.2.xls');

        $spreadsheet = $reader->load('C:\Users\guill\Desktop\Prestaprofe APP\#CAPTURAS\CPdescargav0.2.xls');
        unset($worksheetNames[0]);

        foreach ($worksheetNames as $sheetName) {

            $sheet = $spreadsheet->getSheetByName($sheetName);
            $stateName = $sheet->getCellByColumnAndRow(5, 2)->getValue();
            $stateCode = $sheet->getCellByColumnAndRow(8, 2)->getValue();
            $state = State::firstOrCreate(
                ['name'=>$stateName],
                [
                    'name' => $stateName,
                    'code' => $stateCode
                ]
            );
            foreach ($sheet->getRowIterator(2) as $key => $row) {
                $munName = $sheet->getCell('D'.$key);
                $munCode = $sheet->getCell('L'.$key);
                $cityName = $sheet->getCell('B'.$key);
                $zipCode = $sheet->getCell('A'.$key);

                $municipality = Municipality::firstOrCreate(
                    ['name'=>$munName,
                     'code'=>$munCode],
                    [
                        'name' => $munName,
                        'code' => $munCode,
                        'state_id' => $state->id
                    ]
                );
                $city = City::firstOrCreate(
                    ['name'=>$cityName,
                     'zip_code'=>$zipCode],
                    [
                        'name' => $cityName,
                        'zip_code' => $zipCode,
                        'municipality_id' => $municipality->id
                    ]
                );
            //     $cellIterator = $row->getCellIterator();
            //    $cellIterator->setIterateOnlyExistingCells(TRUE);
            //     foreach ($cellIterator as $cell) {
            //         if($cell->getColumn() == 'E'){
            //             $state = State::firstOrCreate(
            //                 ['name'=>$cell->getValue()],
            //                 []);
            //         }

            //     }

            }

        }

    }


}

class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter {
    public function readCell($columnAddress, $row, $worksheetName = '') {
        if ($columnAddress == 'A' || $columnAddress == 'D' || $columnAddress == 'E' || $columnAddress == 'B' || $columnAddress == 'H' || $columnAddress == 'L') {
            return true;
        }
        return false;
    }
}
