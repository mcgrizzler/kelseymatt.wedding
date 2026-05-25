<?php

namespace App\Http\Middleware;

use App\Models\Invite;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateRsvpToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $invite = Invite::where('token', $request->route('token'))->first();

        if (! $invite) {
            abort(404);
        }

        $request->attributes->set('invite', $invite);

        return $next($request);
    }
}
