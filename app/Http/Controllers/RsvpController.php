<?php

namespace App\Http\Controllers;

use App\Models\Rsvp;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RsvpController extends Controller
{
    public function create()
    {
        return view('rsvp');
    }

    public function store(Request $request)
    {
        $maxGuests = (int) config('wedding.max_guests', 6);
        $mealOptions = config('wedding.meal_options', []);

        $validated = $request->validate([
            'name'                 => ['required', 'string', 'max:255'],
            'email'                => ['nullable', 'email', 'max:255'],
            'attending'            => ['required', 'in:yes,no'],
            'number_of_guests'     => ['required', 'integer', 'min:1', "max:{$maxGuests}"],
            'meal_choice'          => ['nullable', Rule::in($mealOptions)],
            'dietary_restrictions' => ['nullable', 'string', 'max:1000'],
        ]);

        $attending = $validated['attending'] === 'yes';

        Rsvp::create([
            'name'                 => $validated['name'],
            'email'                => $validated['email'] ?? null,
            'attending'            => $attending,
            'number_of_guests'     => $attending ? $validated['number_of_guests'] : 0,
            'meal_choice'          => $attending ? ($validated['meal_choice'] ?? null) : null,
            'dietary_restrictions' => $attending ? ($validated['dietary_restrictions'] ?? null) : null,
        ]);

        return redirect()->route('rsvp.create')->with('rsvp_success', $attending);
    }
}
