<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cedula extends Model
{
    protected $table = 'cedula_form';

    // ✅ Mass assignable fields
    protected $fillable = [
        'user_id',
        'reference_number',
        'name',
        'tin',
        'address',
        'citezenship',
        'civil_status',
        'dob',
        'place_of_birth',
        'height',
        'weight',
        'total_gross_receipt_fr_business',
        'total_earning_fr_salaries',
        'total_income_fr_realproperty',
        'e_signature',
        'email',
        'type',
        'amount',
        'purpose',
        'issue_date',
        'status',
        'id_proof',
        'approval_date',
        'approved_by',
        'release_date',
        'released_by',
    ];


    protected $dates = [
        'dob',
        'issue_date',
        'approval_date',
        'release_date',
        'created_at',
        'updated_at',
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
