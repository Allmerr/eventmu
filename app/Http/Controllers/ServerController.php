<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Server;
use App\Models\Post;
use App\Models\Follower;
use App\Models\Vote;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('servers.index',[
            'servers' => Server::where('is_deleted', '0')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('servers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ];

        $validatedData = $request->validate($rules);


        // string and number random uppercase
        $code = Str::upper(Str::upper(Str::random(5)));

        while (Server::where('code', $code)->where('is_deleted', '0')->exists()) {
            $code = Str::upper(Str::random(5));
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['code'] = $code;

        Server::create($validatedData);

        return redirect()->route('servers.index')->with('success', 'Server created successfully.');
    }

    /**
     * Display the specified resource.
     */
    // can i just show server by code server?
    public function show(Server $server)
    {
        if($server->is_deleted == 1) {
            return redirect()->route('servers.index')->with('error', 'Server not found.');
        }

        return view('servers.show', [
            'server' => $server
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Server $server)
    {
        return view('servers.edit', [
            'server' => $server
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Server $server)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ];

        $validatedData = $request->validate($rules);

        $server->update($validatedData);

        return redirect()->route('servers.index')->with('success', 'Server updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Server $server)
    {
        $server->update([
            'is_deleted' => 1
        ]);

        return redirect()->route('servers.index')->with('success', 'Server deleted successfully.');
    }

    public function page(Request $request, Server $server)
    {
        if(!$server->user_id == auth()->user()->id){
            if($this->isUserFollowServer($server->id) == false){
                return redirect()->route('servers.show', $server->code)->with('error', 'You are not following this server.');
            }
        }

        return view('servers.page', [
            'server' => $server,
            'posts' => Post::where('server_id', $server->id)->where('is_deleted', '0')->get(),
        ]);
    }

    public function postDetail(Request $request, Server $server, Post $post)
    {
        if($this->isPostExist($post->id) == false and $post->is_deleted == 1){
            return redirect()->route('servers.show', $server->code)->with('error', 'Post or Server not found.');
        }

        if(!$server->user_id == auth()->user()->id){
            if($this->isUserFollowServer($server->id) == false){
                return redirect()->route('servers.show', $server->code)->with('error', 'You are not following this server.');
            }
        }

        return view('servers.post_detail', [
            'server' => $server,
            'post' => $post,
            'posts' => Post::where('server_id', $server->id)->where('is_deleted', '0')->orderBy('id', 'DESC')->take(10)->get(),
        ]);
    }

    public function postUpVotes(Request $request, Server $server, Post $post)
    {
        if($this->isUserFollowServer($server->id) == false){
            return redirect()->route('servers.show', $server->code)->with('error', 'You are not following this server.');
        }

        if(Vote::where('user_id', auth()->user()->id)->where('post_id', $post->id)->where('type', 'up')->where('is_deleted', '0')->exists()){
            $vote = Vote::where('user_id', auth()->user()->id)->where('post_id', $post->id)->where('type', 'up')->where('is_deleted', '0')->get()[0];

            $vote->update([
                'is_deleted' => '1'
            ]);

            return redirect()->back()->with('success', 'Unvoted successfully.');
        }

        if(Vote::where('user_id', auth()->user()->id)->where('post_id', $post->id)->where('type', 'down')->where('is_deleted', '0')->exists()){
            $vote = Vote::where('user_id', auth()->user()->id)->where('post_id', $post->id)->where('type', 'down');

            $vote->update([
                'type' => 'up'
            ]);

            return redirect()->back()->with('success', 'Voted Up successfully.');
        }

        Vote::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'type' => 'up',
        ]);

        return redirect()->back()->with('success', 'Voted Up successfully.');

    }

    public function postDownVotes(Request $request, Server $server, Post $post)
    {
        if($this->isUserFollowServer($server->id) == false){
            return redirect()->route('servers.show', $server->code)->with('error', 'You are not following this server.');
        }

        if(Vote::where('user_id', auth()->user()->id)->where('post_id', $post->id)->where('type', 'down')->where('is_deleted', '0')->exists()){
            $vote = Vote::where('user_id', auth()->user()->id)->where('post_id', $post->id)->where('type', 'down')->where('is_deleted', '0')->get()[0];

            $vote->update([
                'is_deleted' => '1'
            ]);

            return redirect()->back()->with('success', 'Unvoted successfully.');
        }

        if(Vote::where('user_id', auth()->user()->id)->where('post_id', $post->id)->where('type', 'up')->exists()){
            $vote = Vote::where('user_id', auth()->user()->id)->where('post_id', $post->id)->where('type', 'up');

            $vote->update([
                'type' => 'down'
            ]);

            return redirect()->back()->with('success', 'Voted Down successfully.');
        }

        Vote::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'type' => 'down',
        ]);

        return redirect()->back()->with('success', 'Voted Down successfully.');

    }

    private function isServerExist($code)
    {
        return Server::where('code', $code)->where('is_deleted', '0')->exists();
    }

    private function isPostExist($post_id)
    {
        return Post::where('id', $post_id)->where('is_deleted', '0')->exists();
    }

    private function isUserFollowServer($server_id)
    {
        return Follower::where('user_id', auth()->user()->id)->where('server_id', $server_id)->where('is_deleted', '0')->exists();
    }

}
