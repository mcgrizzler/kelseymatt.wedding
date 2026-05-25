@extends('layouts.app')

@section('title', 'RSVP')

@section('content')
    <section class="bg-ocean">
        <div class="mx-auto max-w-2xl px-5 py-16 text-center">
            <p class="text-sm uppercase tracking-[0.3em] text-lagoon-600">Will you join us?</p>
            <h1 class="mt-4 text-script text-6xl text-lagoon-800">RSVP</h1>
            <p class="mt-4 font-serif text-lg text-lagoon-700">
                Kindly reply by {{ config('wedding.rsvp_deadline') }}.
            </p>
        </div>
    </section>

    <div class="mx-auto max-w-2xl px-5 py-14">

        @if (session()->has('rsvp_success'))
            {{-- Confirmation --}}
            <div class="rounded-3xl bg-white p-10 text-center shadow-sm ring-1 ring-sand-200">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-lagoon-100 text-3xl">
                    🐚
                </div>
                @if (session('rsvp_success'))
                    <h2 class="mt-6 font-serif text-3xl text-lagoon-800">Yay! We can't wait to see you.</h2>
                    <p class="mt-3 text-lagoon-600">
                        Your RSVP is in. Check out the <a href="{{ route('details') }}" class="text-coral-500 underline">details</a>
                        to plan your trip to the coast.
                    </p>
                @else
                    <h2 class="mt-6 font-serif text-3xl text-lagoon-800">Thank you for letting us know.</h2>
                    <p class="mt-3 text-lagoon-600">We'll miss you, but we appreciate your reply. Sending love your way.</p>
                @endif
                <a href="{{ route('rsvp.create') }}"
                   class="mt-8 inline-block rounded-full bg-white px-6 py-2.5 text-lagoon-700 ring-1 ring-lagoon-200 hover:bg-sand-50 transition">
                    Submit another response
                </a>
            </div>
        @else
            @if ($errors->any())
                <div class="mb-6 rounded-2xl bg-coral-300/30 p-4 text-coral-600 ring-1 ring-coral-300">
                    <p class="font-medium">Please fix the following:</p>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('rsvp.store') }}"
                  class="space-y-6 rounded-3xl bg-white p-8 shadow-sm ring-1 ring-sand-200">
                @csrf

                {{-- Name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-lagoon-700">Full name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                           class="mt-2 w-full rounded-xl border-sand-200 bg-sand-50 px-4 py-3 text-lagoon-900 focus:border-lagoon-400 focus:ring-lagoon-400">
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-lagoon-700">Email <span class="text-lagoon-400">(optional)</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                           class="mt-2 w-full rounded-xl border-sand-200 bg-sand-50 px-4 py-3 text-lagoon-900 focus:border-lagoon-400 focus:ring-lagoon-400">
                </div>

                {{-- Attending --}}
                <div>
                    <span class="block text-sm font-medium text-lagoon-700">Will you be attending?</span>
                    <div class="mt-2 grid grid-cols-2 gap-3" id="attending-group">
                        @foreach (['yes' => 'Joyfully accepts', 'no' => 'Regretfully declines'] as $val => $label)
                            <label class="cursor-pointer rounded-xl border border-sand-200 bg-sand-50 px-4 py-3 text-center has-[:checked]:border-coral-400 has-[:checked]:bg-coral-300/20 has-[:checked]:text-coral-600 transition">
                                <input type="radio" name="attending" value="{{ $val }}" class="sr-only"
                                       {{ old('attending', 'yes') === $val ? 'checked' : '' }}>
                                {{ $label }}
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Attending-only fields --}}
                <div id="attending-fields" class="space-y-6">
                    <div>
                        <label for="number_of_guests" class="block text-sm font-medium text-lagoon-700">Number of guests (including you)</label>
                        <select name="number_of_guests" id="number_of_guests"
                                class="mt-2 w-full rounded-xl border-sand-200 bg-sand-50 px-4 py-3 text-lagoon-900 focus:border-lagoon-400 focus:ring-lagoon-400">
                            @for ($i = 1; $i <= config('wedding.max_guests'); $i++)
                                <option value="{{ $i }}" {{ (int) old('number_of_guests', 1) === $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <label for="meal_choice" class="block text-sm font-medium text-lagoon-700">Meal preference</label>
                        <select name="meal_choice" id="meal_choice"
                                class="mt-2 w-full rounded-xl border-sand-200 bg-sand-50 px-4 py-3 text-lagoon-900 focus:border-lagoon-400 focus:ring-lagoon-400">
                            <option value="">No preference</option>
                            @foreach (config('wedding.meal_options') as $meal)
                                <option value="{{ $meal }}" {{ old('meal_choice') === $meal ? 'selected' : '' }}>{{ $meal }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="dietary_restrictions" class="block text-sm font-medium text-lagoon-700">Dietary restrictions / allergies <span class="text-lagoon-400">(optional)</span></label>
                        <textarea name="dietary_restrictions" id="dietary_restrictions" rows="3"
                                  class="mt-2 w-full rounded-xl border-sand-200 bg-sand-50 px-4 py-3 text-lagoon-900 focus:border-lagoon-400 focus:ring-lagoon-400">{{ old('dietary_restrictions') }}</textarea>
                    </div>
                </div>

                <button type="submit"
                        class="w-full rounded-full bg-coral-500 px-8 py-3.5 text-white font-medium shadow-md hover:bg-coral-600 transition">
                    Send RSVP
                </button>
            </form>
        @endif
    </div>
@endsection
