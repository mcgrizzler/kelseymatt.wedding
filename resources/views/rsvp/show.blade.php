@extends('layouts.app')

@section('title', 'RSVP')

@section('content')
@php
    $p1 = config('wedding.partner_one');
    $p2 = config('wedding.partner_two');
@endphp

<div class="mx-auto max-w-2xl px-5 py-16">
    <div class="text-center mb-10">
        <p class="text-sm uppercase tracking-[0.3em] text-lagoon-500">You're invited</p>
        <h1 class="mt-3 text-script text-6xl text-lagoon-800">{{ $p1 }} &amp; {{ $p2 }}</h1>
        <p class="mt-3 font-serif text-lagoon-600">{{ config('wedding.date_pretty') }}</p>
    </div>

    <div class="rounded-3xl bg-white shadow-sm ring-1 ring-sand-200 p-8 sm:p-10">
        <h2 class="text-xl font-semibold text-lagoon-900 mb-6">Will you be joining us?</h2>

        <livewire:rsvp-form :invite="$invite" />
    </div>

    <p class="mt-8 text-center text-sm text-lagoon-500">
        Kindly reply by <strong>{{ config('wedding.rsvp_deadline') }}</strong>
    </p>
</div>
@endsection
