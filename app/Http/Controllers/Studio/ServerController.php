<?php

namespace App\Http\Controllers\Studio;

use Illuminate\Support\Str;
use App\Models\Server;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    public function index(){
        return view('studio.servers.index', [
            'servers' => auth()->user()->servers()->where('is_deleted', '0')->get()
        ]);
    }

    public function create(){
        return view('studio.servers.create');
    }

    public function store(Request $request){
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

        return redirect()->route('studio.servers.index')->with('success', 'Server created successfully.');
    }

    public function show(Request $request, Server $server){
        return view('studio.servers.show', [
            'server' => $server
        ]);
    }

    public function edit(Request $request, Server $server){
        return view('studio.servers.edit', [
            'server' => $server
        ]);
    }

    public function update(Request $request, Server $server){
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ];

        $validatedData = $request->validate($rules);

        $server->update($validatedData);

        return redirect()->route('studio.servers.index')->with('success', 'Server updated successfully.');
    }

    public function destroy(Server $server)
    {
        $server->update([
            'is_deleted' => '1',
        ]);

        return redirect()->route('studio.servers.index')->with('success', 'Server deleted successfully.');
    }
}
