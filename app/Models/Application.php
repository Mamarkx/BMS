<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;


    protected $table = 'applications';


    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'suffix',
        'dob',
        'civil_status',
        'phone',
        'email',
        'address',
        'type',
        'purpose',
        'issue_date',
        'status',
        'id_proof',
        'address_proof',
        'user_id',
    ];

    protected $dates = [
        'dob',
        'issue_date',
        'created_at',
        'updated_at',
    ];


    protected $casts = [
        'dob' => 'date:Y-m-d',
        'issue_date' => 'date:Y-m-d',
        'approval_date' => 'datetime',
        'release_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
