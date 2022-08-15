<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function __construct()
    {
    }

    public function viewDashboard()
    {
        return view('dashboard.dash');
    }
}
