<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Server;
use App\Services\NicknameService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            "servers" => Server::where('is_deleted', '0')->get(),
        ]);
    }

    public function profile(Request $request, $nickname)
    {
        $nicknameService = new NicknameService();
        $dataNickname = $nicknameService->findNickname($nickname);
        if (is_null($dataNickname)) {
            return abort(404);
        }

        if($dataNickname['type'] == 'user'){
            $user = $dataNickname['user'];
        }else{
            $server = $dataNickname['server'];
        }

        return view('profile', [
            "type" => $dataNickname['type'],
            "user" => $user ?? null,
            "server" => $server ?? null,
        ]);
    }
}
