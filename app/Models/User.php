<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'last_name',
        'birth_date',
        'gender',
        'civil_status',
        'curp',
        'address',
        //'institution_id',
        'type',
        'salary_id',
        'phone',
        'email',
        'password',
        'rfc',
        'ine',
        'ine_back',
        'pay_stub',
        'selfie',
        'proof_address',
        'first_reference_person_name',
        'first_reference_person_phone',
        'second_reference_person_name',
        'second_reference_person_phone',
        'city_id',
        'saving_bank_id',
        'job_id',
        'city_id',
        'is_phone_verified',
        'is_admon_verified',
        'token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function salary()
    {
        return $this->belongsTo(Salary::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    public function savingBanks()
    {
        return $this->hasMany(SavingBank::class);
    }
}
