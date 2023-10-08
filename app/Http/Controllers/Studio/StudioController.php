<?php

namespace App\Http\Controllers\Studio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    public function index(){
        return view('studio.index');
    }
}
