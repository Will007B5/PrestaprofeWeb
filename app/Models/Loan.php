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
        'card_id',
        'user_id',
    ];

    public function loanState()
    {
        return $this->belongsTo(LoanState::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function extensions()
    {
      return $this->hasMany(PaymentExtension::class);
    }

    public function states()
    {
        return $this->belongsToMany(LoanState::class);
    }



}
