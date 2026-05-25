<?php

namespace App\Http\Controllers;

use App\Enums\RsvpStatus;
use App\Models\Invite;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RsvpController extends Controller
{
    public function show(Request $request, string $token): View
    {
        /** @var Invite $invite */
        $invite = $request->attributes->get('invite');
        $invite->load('guests');

        return view('rsvp.show', compact('invite'));
    }

    public function store(Request $request, string $token): RedirectResponse
    {
        /** @var Invite $invite */
        $invite = $request->attributes->get('invite');
        $mealOptions = config('wedding.meal_options', []);

        $validated = $request->validate([
            'attending' => ['required', 'in:yes,no'],
            'guests' => ['required_if:attending,yes', 'array', 'min:1', "max:{$invite->max_guests}"],
            'guests.*.name' => ['required_if:attending,yes', 'string', 'max:255'],
            'guests.*.meal_choice' => ['required_if:attending,yes', Rule::in($mealOptions)],
            'guests.*.dietary_restrictions' => ['nullable', 'string', 'max:1000'],
        ]);

        $attending = $validated['attending'] === 'yes';

        $invite->guests()->delete();

        if ($attending) {
            foreach ($validated['guests'] as $index => $guestData) {
                $invite->guests()->create([
                    'name' => $guestData['name'],
                    'meal_choice' => $guestData['meal_choice'],
                    'dietary_restrictions' => $guestData['dietary_restrictions'] ?? null,
                    'is_primary' => $index === 0,
                ]);
            }
        }

        $invite->update([
            'rsvp_status' => $attending ? RsvpStatus::Confirmed : RsvpStatus::Declined,
            'rsvp_submitted_at' => now(),
        ]);

        return redirect()->route('rsvp.confirm', $token);
    }

    public function confirm(Request $request, string $token): View
    {
        /** @var Invite $invite */
        $invite = $request->attributes->get('invite');
        $invite->load('guests');

        return view('rsvp.confirm', compact('invite'));
    }
}
