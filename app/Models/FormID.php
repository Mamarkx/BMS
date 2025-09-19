<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormID extends Model
{
    protected $table = 'id_form';
    protected $fillable = [
        'user_id',
        'reference_number',
        'name',
        'address',
        'dob',
        'age',
        'place_of_birth',
        'civil_status',
        'email',
        'type',
        'purpose',
        'issue_date',
        'status',
        'religion',
        'height',
        'weight',
        'amount',
        'gender',
        'citezenship',
        'id_proof',
        'precint_number',
        'emergency_name',
        'cellphone_number',
        'emergency_address',
        'approval_date',
        'approved_by',
        'release_date',
        'released_by',
    ];
    protected $casts = [
        'release_date' => 'datetime',
    ];
    // app/Models/FormID.php
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
