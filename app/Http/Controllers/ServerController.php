<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Server;
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


        // string and number random
        $code = Str::random(5);

        while (Server::where('code', $code)->exists()) {
            $code = Str::random(5);
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
}
