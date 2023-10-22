<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'caption',
        'image',
        'server_id',
        'is_deleted',
    ];

    public function server()
    {
        return $this->belongsTo(Server::class);
    }
}
