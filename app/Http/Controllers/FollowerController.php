<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\Server;
use Illuminate\Http\Request;


class FollowerController extends Controller
{
    public function follow(Request $request, Server $server){

        if($server->user_id == auth()->user()->id ){
            return redirect()->route('servers.index')->with('error', 'You cannot follow this server.');
        }

        if($server->is_deleted == '1'){
            return redirect()->route('servers.index')->with('error', 'Server not found.');
        }

        if(Follower::where('server_id', $server->id)->where('user_id', auth()->user()->id)->where('is_deleted', '0')->exists()){
            return redirect()->route('servers.index')->with('error', 'You cannot follow again this server.');
        }

        $validatedData = [
            'server_id' => $server->id,
            'user_id' => auth()->user()->id,
        ];

        Follower::create($validatedData);

        return redirect()->route('servers.index')->with('success', 'Followed successfully.');
    }

    public function unfollow(Request $request, Server $server){
        if(!Follower::where('server_id', $server->id)->where('user_id', auth()->user()->id)->where('is_deleted', '0')->exists()){
            return redirect()->route('servers.index')->with('error', 'You cannot unfollow this server.');
        }

        $follower = Follower::where('server_id', $server->id)->where('user_id', auth()->user()->id)->where('is_deleted', '0')->first();

        $follower->is_deleted = '1';
        $follower->save();

        return redirect()->route('servers.index')->with('success', 'Unfollowed successfully.');
    }
}
