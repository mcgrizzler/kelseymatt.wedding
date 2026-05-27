@extends('layouts.app')

@section('content')
    @php
        $p1 = config('wedding.partner_one');
        $p2 = config('wedding.partner_two');
    @endphp

    {{-- Hero --}}
    <section class="relative overflow-hidden min-h-[55vh] flex items-center"
             style="background-image: url('https://image-tc.galaxy.tf/wijpeg-6sr5mqfvzav8ti5x1qt313b8s/aerial-avalon-2-result.jpg?width=1920'); background-size: cover; background-position: center;">
        <div class="absolute inset-0 bg-lagoon-900/65"></div>

        <div class="relative z-10 mx-auto max-w-3xl px-5 py-24 sm:py-32 text-center w-full">
            <p class="text-sm uppercase tracking-[0.3em] text-white/70">We're getting married!</p>

            <h1 class="mt-6 text-script text-7xl sm:text-8xl text-white leading-none drop-shadow-lg">
                {{ $p1 }} <span class="text-coral-400">&amp;</span> {{ $p2 }}
            </h1>

            <p class="mt-8 text-xl sm:text-2xl font-serif text-white/90">
                {{ config('wedding.date_pretty') }}
            </p>
            <p class="mt-1 font-serif text-white/70 text-lg">
                {{ config('wedding.venue.name') }} &middot; {{ config('wedding.venue.city') }}
            </p>

            {{-- Countdown --}}
            <div id="countdown" data-date="{{ config('wedding.date') }}T16:00:00"
                 class="mt-12 flex flex-wrap justify-center gap-2 sm:gap-6">
                @foreach (['days' => 'Days', 'hours' => 'Hours', 'minutes' => 'Minutes', 'seconds' => 'Seconds', 'ms' => 'Ms'] as $key => $label)
                    <div class="w-14 sm:w-20 rounded-2xl bg-white/15 backdrop-blur-sm px-2 sm:px-3 py-3 ring-1 ring-white/30">
                        <div data-unit="{{ $key }}" class="text-xl sm:text-3xl font-serif font-semibold text-white tabular-nums">--</div>
                        <div class="text-[10px] uppercase tracking-widest text-white/60">{{ $label }}</div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 flex flex-wrap justify-center gap-4">
                <a href="{{ route('magic-link.show') }}"
                   class="rounded-full bg-coral-500 px-8 py-3 text-white font-medium shadow-lg hover:bg-coral-600 transition">
                    RSVP Now
                </a>
                <a href="{{ route('info') }}"
                   class="rounded-full bg-white/20 backdrop-blur-sm px-8 py-3 text-white font-medium ring-1 ring-white/40 hover:bg-white/30 transition">
                    Wedding Info
                </a>
            </div>
        </div>
    </section>

    {{-- Venue photo gallery --}}
    <section class="mx-auto max-w-5xl px-5 pt-16 pb-4">
        <p class="text-center text-sm uppercase tracking-[0.3em] text-lagoon-500 mb-2">Catalina Island, California</p>
        <h2 class="text-center font-serif text-3xl text-lagoon-800 mb-8">Descanso Beach Club</h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
            <div class="col-span-2 row-span-2 overflow-hidden rounded-2xl shadow-md">
                <img src="{{ asset('images/kelsey-matt-engagement.jpg') }}"
                     alt="{{ $p1 }} and {{ $p2 }} at Avalon Harbor, Catalina Island"
                     class="h-full w-full object-cover">
            </div>
            <div class="overflow-hidden rounded-2xl shadow-md">
                <img src="{{ asset('images/kelsey-matt-fountain.jpg') }}"
                     alt="{{ $p1 }} and {{ $p2 }} by the fountain"
                     class="h-48 w-full object-cover">
            </div>
            <div class="overflow-hidden rounded-2xl shadow-md">
                <img src="{{ asset('images/kelsey-matt-doorway.jpg') }}"
                     alt="{{ $p1 }} and {{ $p2 }} together"
                     class="h-48 w-full object-cover">
            </div>
            <div class="overflow-hidden rounded-2xl shadow-md">
                <img src="{{ asset('images/kelsey-matt-throwback.jpg') }}"
                     alt="{{ $p1 }} and {{ $p2 }} in their early days"
                     class="h-48 w-full object-cover">
            </div>
            <div class="overflow-hidden rounded-2xl shadow-md">
                <img src="{{ asset('images/kelsey-matt-formal.jpg') }}"
                     alt="{{ $p1 }} and {{ $p2 }} dressed up for an evening out"
                     class="h-48 w-full object-cover">
            </div>
        </div>
    </section>

    {{-- Quick info cards --}}
    <section class="mx-auto max-w-5xl px-5 py-20">
        <div class="grid gap-6 sm:grid-cols-3">
            @php
                $cards = [
                    ['When', config('wedding.date_pretty'), config('wedding.time')],
                    ['Where', config('wedding.venue.name'), config('wedding.venue.city')],
                    ['Kindly Reply', 'By ' . config('wedding.rsvp_deadline'), 'We can\'t wait to celebrate'],
                ];
            @endphp
            @foreach ($cards as [$heading, $line1, $line2])
                <div class="rounded-3xl bg-white p-8 text-center shadow-sm ring-1 ring-sand-200">
                    <h3 class="text-sm uppercase tracking-[0.25em] text-coral-500">{{ $heading }}</h3>
                    <p class="mt-3 font-serif text-xl text-lagoon-800">{{ $line1 }}</p>
                    <p class="mt-1 text-lagoon-600">{{ $line2 }}</p>
                </div>
            @endforeach
        </div>
    </section>
@endsection
