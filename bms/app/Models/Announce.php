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
        'attachment',
        'publish_date',
    ];

    protected $casts = [
        'publish_date' => 'datetime',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
    ];
}
