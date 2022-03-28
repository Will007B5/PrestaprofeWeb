<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Interest;

class Level extends Model
{
    protected $timestamps = false;

    protected $fillable = [
        'name',
        'min_amount',
        'interest_id'
    ];

    public function clients(){
        return $this->belongsTo(Info_client::class);
    }

    public function interest(){
        return $this->belongsTo(Interest::class);
    }
    


}
