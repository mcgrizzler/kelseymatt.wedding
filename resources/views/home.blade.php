@extends('layouts.app')

@section('content')
    @php
        $p1 = config('wedding.partner_one');
        $p2 = config('wedding.partner_two');
    @endphp

    {{-- Hero --}}
    <section class="bg-ocean relative overflow-hidden">
        {{-- Sun --}}
        <div class="pointer-events-none absolute -top-16 right-10 h-56 w-56 rounded-full bg-sand-200/70 blur-2xl"></div>

        <div class="relative mx-auto max-w-3xl px-5 py-24 sm:py-32 text-center">
            <p class="text-sm uppercase tracking-[0.3em] text-lagoon-600">We're getting married</p>

            <h1 class="mt-6 text-script text-7xl sm:text-8xl text-lagoon-800 leading-none">
                {{ $p1 }} <span class="text-coral-500">&amp;</span> {{ $p2 }}
            </h1>

            <p class="mt-8 text-xl sm:text-2xl font-serif text-lagoon-700">
                {{ config('wedding.date_pretty') }}
            </p>
            <p class="mt-1 font-serif text-lagoon-600 text-lg">
                {{ config('wedding.venue.name') }} &middot; {{ config('wedding.venue.city') }}
            </p>

            {{-- Countdown --}}
            <div id="countdown" data-date="{{ config('wedding.date') }}T16:00:00"
                 class="mt-12 flex justify-center gap-4 sm:gap-6">
                @foreach (['days' => 'Days', 'hours' => 'Hours', 'minutes' => 'Minutes', 'seconds' => 'Seconds'] as $key => $label)
                    <div class="w-18 sm:w-20 rounded-2xl bg-white/70 px-3 py-3 shadow-sm ring-1 ring-white/60">
                        <div data-unit="{{ $key }}" class="text-2xl sm:text-3xl font-serif font-semibold text-lagoon-800">--</div>
                        <div class="text-[10px] uppercase tracking-widest text-lagoon-500">{{ $label }}</div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 flex flex-wrap justify-center gap-4">
                <a href="{{ route('rsvp.create') }}"
                   class="rounded-full bg-coral-500 px-8 py-3 text-white font-medium shadow-md hover:bg-coral-600 transition">
                    RSVP Now
                </a>
                <a href="{{ route('details') }}"
                   class="rounded-full bg-white/70 px-8 py-3 text-lagoon-700 font-medium ring-1 ring-lagoon-200 hover:bg-white transition">
                    Wedding Details
                </a>
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
