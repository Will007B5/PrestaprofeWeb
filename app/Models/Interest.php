<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model{
    protected $table = "interest";
    protected $timestamps = false;

    protected $fillable = [
        'percent'
    ];

    public function levels(){
        return $this->hasMany(Level::class);
    }

}