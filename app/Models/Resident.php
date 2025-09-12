<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    // Define the table associated with the model (if different from plural of class name)
    protected $table = 'residents';

    // Define the primary key
    protected $primaryKey = 'resident_id';

    // Define which attributes are mass assignable
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'sex',
        'birth_date',
        'civil_status',
        'address',
        'photo_path',
        'status',
    ];
}
