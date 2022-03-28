<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentExtension extends Model
{
    use HasFactory;

    protected $fillable = [
        'start',
        'end',
        'loan'
    ];

    public function loan()
    {
       $this->belongsTo(Loan::class);
    }
}
