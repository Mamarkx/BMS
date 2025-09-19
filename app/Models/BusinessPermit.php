<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessPermit extends Model
{
    protected $table = 'business_permit';
    protected $fillable = [
        'user_id',
        'reference_number',
        'name_owner',
        'name_business',
        'address_business',
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
    protected $casts = [
        'release_date' => 'datetime',
    ];
    // app/Models/FormID.php
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
