<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment_type extends Model
{
    protected $timestamps = false;

    protected $fillable = [
        'range',
        'chances'
    ];

    public function loans(){
        return $this->hasMany(Loan::class);
    }
}
