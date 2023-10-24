<?php

namespace App\Http\Controllers\Studio;

use App\Models\Post;
use App\Models\Server;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Server $server)
    {
        return view('studio.servers.posts.index', [
            'posts' => Post::where('server_id', $server->id)->where('is_deleted', '0')->get(),
            'server' => $server,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, Server $server)
    {
        return view('studio.servers.posts.create', [
            'server' => $server,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Server $server)
    {
        // check if own server
        $isMyOwnServer = $server->user_id === auth()->user()->id;

        if(!$isMyOwnServer) {
            return redirect()->route('studio.servers.create')->with('error', 'You do not own this server.');
        }

        $rules = [
            'caption' => 'required|string',
        ];

        if($request->hasFile('image')) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg';
        }

        $validatedData = $request->validate($rules);

        $validatedData['server_id'] = $server->id;
        if($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('posts_images');
        }

        Post::create($validatedData);

        return redirect()->route('studio.servers.posts.index', $server->code)->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Server $server, Post $post)
    {
        return view('studio.servers.posts.show', [
            'server' => $post->server,
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Server $server, Post $post)
    {
        return view('studio.servers.posts.edit', [
            'server' => $post->server,
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Server $server, Post $post)
    {
        // check if own server
        $isMyOwnServer = $server->user_id === auth()->user()->id;

        if(!$isMyOwnServer) {
            return redirect()->route('studio.servers.create')->with('error', 'You do not own this server.');
        }

        $rules = [
            'caption' => 'required|string',
        ];

        if($request->hasFile('image')) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg';
        }

        $validatedData = $request->validate($rules);

        $validatedData['server_id'] = $server->id;
        if($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('posts_images');
        }

        $post->update($validatedData);

        return redirect()->route('studio.servers.posts.index', $server->code)->with('success', 'Post created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Server $server, Post $post)
    {
        $post->update([
            'is_deleted' => '1',
        ]);

        return redirect()->route('studio.servers.posts.index', $server->id)->with('success', 'Post deleted successfully.');
    }
}
