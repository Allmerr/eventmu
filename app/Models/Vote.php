<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'value',
        'user_id',
        'post_id',
        'comment_id',
        'is_deleted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
