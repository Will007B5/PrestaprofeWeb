<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use Illuminate\Support\Facades\Validator;

class LoanController extends Controller
{
    public function index()
    {
        return Loan::all();
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $rules  = [
            'payment_reference' => 'required|string',
            'amount' => 'numeric|min:1',
            'payment_schema' => 'required|in:biweekly,monthly',
            //'application_date' => 'required|date',
            //'payment_proof' => 'nullable',
            //'expired_date',
            //'accepted_date',
            //'frozen_date',
            'card_id',
            'user_id',
        ];

        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response($validator->errors(), 422);
        }else{

            $loan = loan::create($data);
            return $loan;
        }
    }

    public function update(Request $request, Loan $loan)
    {

    }

    public function show(Loan $loan)
    {
       return $loan;
    }
}
