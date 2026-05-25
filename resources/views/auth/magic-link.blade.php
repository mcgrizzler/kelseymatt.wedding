@extends('layouts.app')

@section('title', 'Access Your RSVP')

@section('content')
@php
    $p1 = config('wedding.partner_one');
    $p2 = config('wedding.partner_two');
@endphp

<div class="mx-auto max-w-md px-5 py-20">
    <div class="text-center mb-10">
        <p class="text-sm uppercase tracking-[0.3em] text-lagoon-500">RSVP Access</p>
        <h1 class="mt-3 text-script text-6xl text-lagoon-800">{{ $p1 }} &amp; {{ $p2 }}</h1>
        <p class="mt-3 font-serif text-lagoon-600">{{ config('wedding.date_pretty') }}</p>
    </div>

    <div class="rounded-3xl bg-white shadow-sm ring-1 ring-sand-200 p-8 sm:p-10">

        @if (session('status'))
            <div class="mb-6 rounded-xl bg-lagoon-50 ring-1 ring-lagoon-100 px-4 py-3 text-sm text-lagoon-700">
                {{ session('status') }}
            </div>
        @endif

        @if (! session('status'))
            <h2 class="text-lg font-semibold text-lagoon-900 mb-2">Access your RSVP</h2>
            <p class="text-sm text-lagoon-500 mb-6">
                Enter the email address you were invited with and we'll send you a link to view or update your RSVP.
            </p>

            <form method="POST" action="{{ route('magic-link.send') }}">
                @csrf

                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-lagoon-700 mb-1">Email Address</label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           class="w-full rounded-xl border border-sand-200 bg-sand-50 px-4 py-2.5 text-lagoon-900 focus:border-lagoon-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-lagoon-200 transition"
                           placeholder="you@example.com">
                    @error('email')
                        <p class="mt-1 text-sm text-coral-600">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="w-full rounded-full bg-coral-500 px-8 py-3 text-white font-medium shadow-sm hover:bg-coral-600 transition">
                    Send My Link
                </button>
            </form>
        @endif
    </div>
</div>
@endsection
