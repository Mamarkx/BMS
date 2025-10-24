<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function ShowDashboard()
    {
        $totalUsers = Resident::count();

        return view('AdminSide.Admin', compact('totalUsers'));
    }
}
