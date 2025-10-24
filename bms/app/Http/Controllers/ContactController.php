<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email',
            'subject' => 'required|string|max:150',
            'message' => 'required|string|max:2000',
        ]);

        Mail::to('johnmarkbalacy3@gmail.com')->send(new ContactMail($request));

        return back()->with('success', 'Message sent successfully! We will contact you soon.');
    }
}
