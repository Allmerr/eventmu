<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'content',
        'post_id',
        'comment_id',
        'user_id',
        'is_deleted',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function replies(){
        return $this->hasMany(Comment::class, 'comment_id')->where('is_deleted', '0');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function countVotes()
    {
        $upVotes = $this->votes()->where('value', 'up')->where('is_deleted', '0')->count();
        $downVotes = $this->votes()->where('value', 'down')->where('is_deleted', '0')->count();

        return $upVotes - $downVotes;
    }
}
