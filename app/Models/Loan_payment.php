<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan_payment extends Model
{
    protected $fillable = [
        'loan',
        'payment',
    ];
}
