<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Server;
use App\Models\Post;
use App\Models\Follower;
use App\Models\Comment;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {

        $rules = [
            'type' => 'required|in:post,comment',
            'value' => 'required|in:up,down',
        ];

        if($request->type == 'post'){
            $rules['post_id'] = 'required|exists:posts,id';
        }else{
            $rules['comment_id'] = 'required|exists:comments,id';
        }

        $validatedData = $request->validate($rules);

        $validatedData['user_id'] = auth()->user()->id;

        // define some variables
        $serverId;

        if($request->type == 'post'){
            $serverId = Post::find($validatedData['post_id'])->server_id;
        }else{
            if(Comment::find($validatedData['comment_id'])->type == 'comment'){
                $serverId = Post::find(Comment::find(Comment::find($validatedData['comment_id'])->comment_id)->post_id)->server_id;
            }else{
                $serverId = Post::find(Comment::find($validatedData['comment_id'])->post_id)->server_id;
            }
        }

        $userId = $validatedData['user_id'];

        // check if user is owner of server or follower of server
        if(!Server::where('user_id', $userId)->where('id', $serverId)->where('is_deleted', '0')->exists() && !Follower::where('user_id', $userId)->where('server_id', $serverId)->where('is_deleted', '0')->exists()){
            return redirect()->back()->with('error', 'Voter must be follower or owner of server.');
        }

         // check if already voted
         if($request->type == 'post'){
            if(Vote::where('user_id', $userId)->where('post_id', $request->post_id)->where('is_deleted', '0')->exists()){
                $vote = Vote::where('user_id', $userId)->where('post_id', $request->post_id)->where('is_deleted', '0')->get()[0];

                if($vote->value == 'up' && $validatedData['value'] == 'up'){
                    $vote->update([
                        'is_deleted' => '1',
                    ]);
                }else if($vote->value == 'up' && $validatedData['value'] == 'down'){
                    $vote->update([
                        'value' => 'down',
                    ]);
                }else if($vote->value == 'down' && $validatedData['value'] == 'up'){
                    $vote->update([
                        'value' => 'up',
                    ]);
                }else if($vote->value == 'down' && $validatedData['value'] == 'down'){
                    $vote->update([
                        'is_deleted' => '1',
                    ]);
                }
            }else{
                Vote::create($validatedData);
            }
         }else{
            if(Vote::where('user_id', $userId)->where('comment_id', $request->comment_id)->where('is_deleted', '0')->exists()){
                $vote = Vote::where('user_id', $userId)->where('comment_id', $request->comment_id)->where('is_deleted', '0')->get()[0];

                if($vote->value == 'up' && $validatedData['value'] == 'up'){
                    $vote->update([
                        'is_deleted' => '1',
                    ]);
                }else if($vote->value == 'up' && $validatedData['value'] == 'down'){
                    $vote->update([
                        'value' => 'down',
                    ]);
                }else if($vote->value == 'down' && $validatedData['value'] == 'up'){
                    $vote->update([
                        'value' => 'up',
                    ]);
                }else if($vote->value == 'down' && $validatedData['value'] == 'down'){
                    $vote->update([
                        'is_deleted' => '1',
                    ]);
                }
            }else{
                Vote::create($validatedData);
            }
         }





        return redirect()->back()->with('success', 'Vote Up successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vote $vote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vote $vote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vote $vote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vote $vote)
    {
        //
    }
}
