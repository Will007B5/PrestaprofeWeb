<?php

namespace App\Models;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PaymentExtension;

class Loan extends Model
{
    protected $fillable = [
        'base_amount',
        'total_amount',
        'card',
        'user',
        'payment_references_id',
        'payment_types_id'
    ];

    public function card(){
      return $this->belongsTo(Card::class);
    }

    public function payment_reference(){
      return $this->belongsTo(Payment_reference::class);
    }

    public function payment_types(){
      return $this->belongsTo(Payment_reference::class);
    }

    public function payments(){
      return $this->belongsToMany(Payment::class);
    }

    public function payment_extensions(){
      return $this->hasMany(PaymentExtension::class);
    }

    public function user(){
      return $this->belongsTo(User::class);
    }

    public function states(){
      return $this->belongsToMany(LoanState::class, 'loan_loanstate');
    }
}
