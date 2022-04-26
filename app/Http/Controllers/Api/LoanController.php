<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function index(){
        $res=[];
        $lista=[];
        $loans= DB::table('users as us')->select('us.name','us.last_name','lo.base_amount','lo.application_date','lo.term', 'ls.name as state', 'ls.id as idState', 'lo.id')
        ->join('loans as lo','lo.user_id','=','us.id')
        ->join('loan_loanstate as los','los.loan_id','=','lo.id')
        ->join('loan_states as ls', 'ls.id','=','los.loan_state_id')
        ->where('los.active','=',1)->get();

        foreach ($loans as $loan) {
            $res=DB::table('loan_states as ls')->select('ls.id','ls.name')
            ->where('ls.id','>',$loan->idState)->get();
            $loan->accions=$res;
        }

        return $loans;

        $idState = DB::table('loan_states as ls')->select('ls.id')
        ->join('loan_loanstate as los','ls.id', 'los.loan_state_id')
        ->join('loans as lo','lo.id','los.loan_id')
        ->join('users as us','us.id','lo.user_id')
        ->where('los.active',1)->where('us.id',2)->first();
        
        DB::table('loan_states as ls')->select('ls.id','ls.name')
        ->where('ls.id','>',$idState->id)->get();
    }
}
