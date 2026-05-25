@extends('layouts.app')

@section('title', 'RSVP')

@section('content')
@php
    $p1 = config('wedding.partner_one');
    $p2 = config('wedding.partner_two');
    $mealOptions = config('wedding.meal_options', []);
    $defaultGuests = [['name' => $invite->name, 'meal_choice' => '', 'dietary_restrictions' => '']];
@endphp

<div class="mx-auto max-w-2xl px-5 py-16">
    <div class="text-center mb-10">
        <p class="text-sm uppercase tracking-[0.3em] text-lagoon-500">You're invited</p>
        <h1 class="mt-3 text-script text-6xl text-lagoon-800">{{ $p1 }} &amp; {{ $p2 }}</h1>
        <p class="mt-3 font-serif text-lagoon-600">{{ config('wedding.date_pretty') }}</p>
    </div>

    <div class="rounded-3xl bg-white shadow-sm ring-1 ring-sand-200 p-8 sm:p-10"
         x-data="rsvpForm({{ $invite->max_guests }}, '{{ $invite->name }}')"
         x-init="init()">

        <h2 class="text-xl font-semibold text-lagoon-900 mb-6">Will you be joining us?</h2>

        <form method="POST" action="{{ route('rsvp.store', $invite->token) }}">
            @csrf

            {{-- Attending toggle --}}
            <div class="flex gap-4 mb-8">
                <label class="flex-1">
                    <input type="radio" name="attending" value="yes" class="sr-only peer"
                           x-model="attending" @change="attending = 'yes'">
                    <div class="cursor-pointer rounded-xl border-2 p-4 text-center transition
                                border-sand-200 peer-checked:border-lagoon-500 peer-checked:bg-lagoon-50">
                        <span class="block text-2xl mb-1">🎉</span>
                        <span class="font-medium text-lagoon-800">Joyfully Accepts</span>
                    </div>
                </label>
                <label class="flex-1">
                    <input type="radio" name="attending" value="no" class="sr-only peer"
                           x-model="attending" @change="attending = 'no'">
                    <div class="cursor-pointer rounded-xl border-2 p-4 text-center transition
                                border-sand-200 peer-checked:border-coral-400 peer-checked:bg-coral-50">
                        <span class="block text-2xl mb-1">💌</span>
                        <span class="font-medium text-lagoon-800">Regretfully Declines</span>
                    </div>
                </label>
            </div>

            @error('attending')
                <p class="text-sm text-coral-600 mb-4">{{ $message }}</p>
            @enderror

            {{-- Guest fields (shown when attending) --}}
            <div x-show="attending === 'yes'" x-cloak>
                <template x-for="(guest, index) in guests" :key="index">
                    <div class="mb-6 rounded-2xl bg-sand-50 ring-1 ring-sand-200 p-5">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-semibold text-lagoon-800"
                                x-text="index === 0 ? 'Your Details' : 'Guest ' + index"></h3>
                            <button type="button"
                                    x-show="index > 0"
                                    @click="removeGuest(index)"
                                    class="text-sm text-coral-500 hover:text-coral-700 transition">
                                Remove
                            </button>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-lagoon-700 mb-1">
                                    Full Name <span class="text-coral-500">*</span>
                                </label>
                                <input type="text"
                                       :name="'guests[' + index + '][name]'"
                                       x-model="guest.name"
                                       class="w-full rounded-xl border border-sand-200 bg-white px-4 py-2.5 text-lagoon-900 focus:border-lagoon-400 focus:outline-none focus:ring-2 focus:ring-lagoon-200"
                                       placeholder="Full name">
                                @if($errors->has('guests.*.name'))
                                    <p class="text-sm text-coral-600 mt-1">{{ $errors->first('guests.*.name') }}</p>
                                @endif
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-lagoon-700 mb-1">
                                    Meal Choice <span class="text-coral-500">*</span>
                                </label>
                                <select :name="'guests[' + index + '][meal_choice]'"
                                        x-model="guest.meal_choice"
                                        class="w-full rounded-xl border border-sand-200 bg-white px-4 py-2.5 text-lagoon-900 focus:border-lagoon-400 focus:outline-none focus:ring-2 focus:ring-lagoon-200">
                                    <option value="">Select a meal…</option>
                                    @foreach ($mealOptions as $meal)
                                        <option value="{{ $meal }}">{{ $meal }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('guests.*.meal_choice'))
                                    <p class="text-sm text-coral-600 mt-1">{{ $errors->first('guests.*.meal_choice') }}</p>
                                @endif
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-lagoon-700 mb-1">
                                    Dietary Restrictions
                                    <span class="text-lagoon-400 font-normal">(optional)</span>
                                </label>
                                <textarea :name="'guests[' + index + '][dietary_restrictions]'"
                                          x-model="guest.dietary_restrictions"
                                          rows="2"
                                          placeholder="Allergies, dietary needs…"
                                          class="w-full rounded-xl border border-sand-200 bg-white px-4 py-2.5 text-lagoon-900 focus:border-lagoon-400 focus:outline-none focus:ring-2 focus:ring-lagoon-200 resize-none"></textarea>
                            </div>
                        </div>
                    </div>
                </template>

                {{-- Add guest button --}}
                <button type="button"
                        x-show="maxGuests > 1 && guests.length < maxGuests"
                        @click="addGuest()"
                        class="mb-6 flex items-center gap-2 text-sm font-medium text-lagoon-600 hover:text-lagoon-800 transition">
                    <span class="flex h-7 w-7 items-center justify-center rounded-full bg-lagoon-100 text-lagoon-700 text-lg leading-none">+</span>
                    Add another guest
                    <span class="text-lagoon-400" x-text="'(' + guests.length + '/' + maxGuests + ')'"></span>
                </button>
            </div>

            {{-- Submit --}}
            <button type="submit"
                    class="w-full rounded-full bg-coral-500 px-8 py-3 text-white font-medium shadow-sm hover:bg-coral-600 transition">
                Confirm RSVP
            </button>
        </form>
    </div>

    <p class="mt-8 text-center text-sm text-lagoon-500">
        Kindly reply by <strong>{{ config('wedding.rsvp_deadline') }}</strong>
    </p>
</div>

<script>
function rsvpForm(maxGuests, primaryName) {
    return {
        attending: '',
        maxGuests: maxGuests,
        guests: [{ name: primaryName, meal_choice: '', dietary_restrictions: '' }],
        init() {
            // Restore old input on validation failure
            @if(old('attending'))
                this.attending = '{{ old('attending') }}';
            @endif
            @if(old('guests'))
                this.guests = @json(old('guests', $defaultGuests));
            @endif
        },
        addGuest() {
            if (this.guests.length < this.maxGuests) {
                this.guests = [...this.guests, { name: '', meal_choice: '', dietary_restrictions: '' }];
            }
        },
        removeGuest(index) {
            if (index > 0) {
                this.guests.splice(index, 1);
            }
        },
    };
}
</script>
@endsection
