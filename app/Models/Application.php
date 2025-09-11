<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    // Define the table name if it's not following Laravel's convention
    protected $table = 'applications';

    // Specify which attributes can be mass-assigned
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
        'id_proof',        // File path for ID proof
        'address_proof',   // File path for Address proof
    ];

    // Specify the date attributes if using Carbon for date manipulation
    protected $dates = [
        'dob',
        'issue_date',
        'created_at',
        'updated_at',
    ];

    // If you want to manipulate dates with a specific format, you can do it here
    protected $casts = [
        'dob' => 'date:Y-m-d',
        'issue_date' => 'date:Y-m-d',
    ];
}
