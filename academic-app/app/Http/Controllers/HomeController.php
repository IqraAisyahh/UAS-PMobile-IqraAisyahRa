<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['permission:view_dashboard']);
    }

    public function dashboard()
    {

        return view('dashboard');

        return abort(403);

    }

}
