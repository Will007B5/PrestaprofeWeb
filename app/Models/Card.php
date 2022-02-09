<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{

    use HasFactory;

    protected $fillable = [
        'card_number',
        'expired_date',
        'user_id',
        'clabe',
        'active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
