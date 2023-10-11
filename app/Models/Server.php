<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'code',
        'user_id',
        'is_deleted',
    ];

    public function getRouteKeyName()
    {
        return 'code';
    }
}
