<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->where('is_deleted', '0');
    }

    public function countVotes()
    {
        $upVotes = $this->votes()->where('value', 'up')->where('is_deleted', '0')->count();
        $downVotes = $this->votes()->where('value', 'down')->where('is_deleted', '0')->count();

        return $upVotes - $downVotes;
    }

    public function countComments()
    {
        return $this->comments()->count();
    }

    public function getRouteKeyName()
    {
        return 'code';
    }

    // Register a creating event for the Server model
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->code = $post->generateUniqueCode();
        });
    }

    // Generate a unique code for the server
    private function generateUniqueCode()
    {
        $code = Str::random(10);

        while (Post::where('code', $code)->exists()) {
            $code = Str::random(10);
        }

        return $code;
    }
}
