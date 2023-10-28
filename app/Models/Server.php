<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


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

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function follower(){
        return $this->hasMany(Follower::class);
    }

    public function countFollowers(){
        return $this->follower()->where('is_deleted', '0')->count();
    }

    public function getRouteKeyName()
    {
        return 'code';
    }

    // Register a creating event for the Server model
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($server) {
            $server->code = $server->generateUniqueCode();
        });
    }

    // Generate a unique code for the server
    private function generateUniqueCode()
    {
        $code = Str::upper(Str::random(5));

        while (Server::where('code', $code)->exists()) {
            $code = Str::upper(Str::random(5));
        }

        return $code;
    }

}
