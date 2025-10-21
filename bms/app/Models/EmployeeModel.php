<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeModel extends Model
{
    protected $table = 'personnel';


    protected $fillable = [
        'personnel_id',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'birthdate',
        'contact_number',
        'email',
        'address',
        'position_title',
        'department',
        'hire_date',
        'status',
        'emergency_contact',
        'emergency_number',
    ];
}
