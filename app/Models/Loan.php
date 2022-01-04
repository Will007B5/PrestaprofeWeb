<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{

    use HasFactory;

    protected $fillable = [
        'payment_reference',
        'amount',
        'payment_schema',
        'application_date',
        'payment_proof',
        'expired_date',
        'accepted_date',
        'frozen_date',
        'loan_state_id',
        'card_id',
    ];


}
