<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announce extends Model
{
    protected $table = 'announcements';
    protected $fillable = [
        'title',
        'content',
        'category',
        'publish_date',
        'attachment'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
