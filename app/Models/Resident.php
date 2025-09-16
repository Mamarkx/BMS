<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;


    protected $table = 'residents';


    protected $primaryKey = 'resident_id';


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
