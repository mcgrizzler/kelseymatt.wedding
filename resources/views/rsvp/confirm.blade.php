@extends('layouts.app')

@section('title', 'RSVP Confirmed')

@section('content')
@php
    $p1 = config('wedding.partner_one');
    $p2 = config('wedding.partner_two');
    $confirmed = $invite->rsvp_status->value === 'confirmed';
@endphp

<div class="mx-auto max-w-2xl px-5 py-16 text-center">
    <div class="mb-10">
        @if ($confirmed)
            <span class="text-5xl">🎉</span>
            <h1 class="mt-4 text-script text-6xl text-lagoon-800">See you there!</h1>
            <p class="mt-3 font-serif text-lagoon-600 text-lg">
                We can't wait to celebrate with you on {{ config('wedding.date_pretty') }}.
            </p>
        @else
            <span class="text-5xl">💌</span>
            <h1 class="mt-4 text-script text-6xl text-lagoon-800">We'll miss you</h1>
            <p class="mt-3 font-serif text-lagoon-600 text-lg">
                Thank you for letting us know, {{ $invite->name }}.
            </p>
        @endif
    </div>

    @if ($confirmed && $invite->guests->isNotEmpty())
        <div class="rounded-3xl bg-white shadow-sm ring-1 ring-sand-200 p-8 sm:p-10 text-left mb-8">
            <h2 class="text-lg font-semibold text-lagoon-900 mb-5">Your party</h2>

            <div class="divide-y divide-sand-100">
                @foreach ($invite->guests as $guest)
                    <div class="py-4 flex items-start justify-between gap-4">
                        <div>
                            <p class="font-medium text-lagoon-900">
                                {{ $guest->name }}
                                @if ($guest->is_primary)
                                    <span class="ml-2 text-xs font-normal text-lagoon-400 uppercase tracking-wide">you</span>
                                @endif
                            </p>
                            @if ($guest->dietary_restrictions)
                                <p class="text-sm text-lagoon-500 mt-0.5">{{ $guest->dietary_restrictions }}</p>
                            @endif
                        </div>
                        <span class="shrink-0 rounded-full bg-sand-100 px-3 py-1 text-sm text-lagoon-700">
                            {{ $guest->meal_choice ?? 'No meal selected' }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="rounded-2xl bg-lagoon-50 ring-1 ring-lagoon-100 px-6 py-5 text-sm text-lagoon-700 mb-8">
        <p>Need to make a change?
            <a href="{{ route('rsvp.show', $invite->token) }}" class="font-medium text-lagoon-800 underline underline-offset-2 hover:text-coral-500 transition">
                Update your RSVP
            </a>
            any time before {{ config('wedding.rsvp_deadline') }}.
        </p>
    </div>

    <a href="{{ route('home') }}"
       class="inline-block rounded-full bg-coral-500 px-8 py-3 text-white font-medium shadow-sm hover:bg-coral-600 transition">
        Back to Home
    </a>
</div>
@endsection
