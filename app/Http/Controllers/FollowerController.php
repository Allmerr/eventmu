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

        $validatedData = [
            'server_id' => $server->id,
            'user_id' => auth()->user()->id,
        ];

        Follower::create($validatedData);

        return redirect()->route('servers.index')->with('success', 'Followed successfully.');
    }
}
