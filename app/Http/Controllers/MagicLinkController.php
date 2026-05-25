<?php

namespace App\Http\Controllers;

use App\Mail\LoginLinkEmail;
use App\Models\Invite;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class MagicLinkController extends Controller
{
    public function show(): View
    {
        return view('auth.magic-link');
    }

    public function send(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $invite = Invite::where('email', $request->email)->first();

        if ($invite) {
            Mail::to($invite->email)->send(new LoginLinkEmail($invite));
        }

        return redirect()->route('magic-link.show')
            ->with('status', 'If we have your email on file, you\'ll receive a link shortly.');
    }
}
