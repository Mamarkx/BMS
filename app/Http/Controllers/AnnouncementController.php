<?php

namespace App\Http\Controllers;

use App\Models\Announce;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function showAnnounce()
    {
        $announce = Announce::all();
        return view('AdminSide.Announcement', compact('announce'));
    }
}
