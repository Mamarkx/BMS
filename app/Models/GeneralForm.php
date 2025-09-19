<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralForm extends Model
{

    protected $table = 'general_form';
    protected $fillable = [
        'user_id',
        'reference_number',
        'first_name',
        'last_name',
        'middle_name',
        'suffix',
        'dob',
        'civil_status',
        'year_of_residency',
        'email',
        'place_of_birth',
        'age',
        'address',
        'amount',
        'type',
        'purpose',
        'issue_date',
        'status',
        'id_proof',
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
