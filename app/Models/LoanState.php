<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Loan;

class LoanState extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];
    
    public function loans(){
        return $this->belongsToMany(Loan::class);
    }
}
