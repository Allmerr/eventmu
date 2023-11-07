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
        $upVotes = $this->votes()->where('type', 'up')->where('is_deleted', '0')->count();
        $downVotes = $this->votes()->where('type', 'down')->where('is_deleted', '0')->count();

        return $upVotes - $downVotes;
    }
}
