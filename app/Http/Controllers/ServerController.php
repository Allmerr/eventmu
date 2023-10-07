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
        return view('server.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('server.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
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

        return redirect()->route('server.index')->with('success', 'Server created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Server $server)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Server $server)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Server $server)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Server $server)
    {
        //
    }
}
