<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\Payment;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index(){
        $res=[];
        $lista=[];
        $loans= Loan::all();
        foreach($loans as $valor){
            $res["name"]=$valor->user->name.' '.$valor->user->last_name;
            $res["base_amount"]=$valor->base_amount;
            $res["application_date"]=$valor->application_date;
            $res["term"]=$valor->term;
            $res["state"]=$valor->state;
            $res["id"]=$valor->id;
            array_push($lista,$res);
        }
        return $lista;
    }
}
