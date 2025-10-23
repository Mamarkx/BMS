<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TwoFactorCode extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'code', 'expires_at'];

    protected $dates = ['expires_at'];

    // ✅ Add this method
    public function isExpired()
    {
        return Carbon::now('Asia/Manila')->greaterThan($this->expires_at);
    }

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
