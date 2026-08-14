<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessage;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('storefront.contact', [
            'settings' => SiteSetting::all()->pluck('value', 'key')->toArray(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'topic' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        $recipient = SiteSetting::where('key', 'email')->value('value') ?: config('mail.from.address');

        Mail::to($recipient)->send(new ContactMessage(
            $validated['name'],
            $validated['email'],
            $validated['topic'],
            $validated['message'],
        ));

        return redirect()->route('contact')->with('success', 'Thanks for reaching out — we\'ll get back to you soon.');
    }
}
