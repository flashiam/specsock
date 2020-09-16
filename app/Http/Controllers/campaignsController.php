<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;

class campaignsController extends Controller
{
    public function index(){
        $window = "campaigns";
        return View::make('campaigns')->with('window', $window);
    }
}
