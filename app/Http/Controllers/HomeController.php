<?php

namespace App\Http\Controllers;

use App\Models\Immunization;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vaccine;

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
    public function dashboard()
    {
        $user_rows = User::count();
        $vaccine_rows = Vaccine::count();
        $immunization_rows = Immunization::count();
        return view('dashboard', compact('user_rows','vaccine_rows','immunization_rows'));
    }

    
}
