<?php

namespace App\Http\Controllers\Studio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    public function index(){
        return view('studio.servers.index');
    }
}
