<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;

class pagesController extends Controller
{
    public function index(){
        $window = "pages";
        return View::make('pages')->with('window', $window);
    }
}
