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
                {{ $p1 }}<span class="text-coral-400 inline-block text-[0.6em] mx-[0.2em] align-middle">&amp;</span>{{ $p2 }}
            </h1>

            <p class="mt-8 text-xl sm:text-2xl font-serif text-white/90">
                {{ config('wedding.date_pretty') }}
            </p>
            <p class="mt-1 font-serif text-white/70 text-lg">
                {{ config('wedding.venue.name') }} &middot; {{ config('wedding.venue.city') }}
            </p>

            {{-- Countdown --}}
            <div id="countdown" data-date="{{ config('wedding.date') }}T16:00:00"
                 class="mt-12 flex justify-center gap-4 sm:gap-6">
                @foreach (['days' => 'Days', 'hours' => 'Hours', 'minutes' => 'Minutes', 'seconds' => 'Seconds'] as $key => $label)
                    <div class="w-18 sm:w-20 rounded-2xl bg-white/15 backdrop-blur-sm px-3 py-3 ring-1 ring-white/30">
                        <div data-unit="{{ $key }}" class="text-2xl sm:text-3xl font-serif font-semibold text-white">--</div>
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
                <img src="https://image-tc.galaxy.tf/wijpeg-5xrr5svfs41d9vdogt6fha6vl/cabana-1835.jpg?width=1920"
                     alt="Descanso Beach Club beachside lounge"
                     class="h-full w-full object-cover">
            </div>
            <div class="overflow-hidden rounded-2xl shadow-md">
                <img src="https://image-tc.galaxy.tf/wijpeg-4ts05gukkrunvtdj4cz9750cr/catalina-20180411-2233-bluesky.jpg?width=860"
                     alt="Descanso Beach with blue sky"
                     class="h-48 w-full object-cover">
            </div>
            <div class="overflow-hidden rounded-2xl shadow-md">
                <img src="https://image-tc.galaxy.tf/wijpeg-9m21zgvi9wa2j9kpvdbyc2wcc/cabana-2341.jpg?width=860"
                     alt="Descanso Beach Club cabana"
                     class="h-48 w-full object-cover">
            </div>
            <div class="overflow-hidden rounded-2xl shadow-md">
                <img src="https://image-tc.galaxy.tf/wijpeg-71un4g8ebbcznyxacen7t51up/1q9b4594.jpg?width=860"
                     alt="Descanso Beach chaise lounges"
                     class="h-48 w-full object-cover">
            </div>
            <div class="overflow-hidden rounded-2xl shadow-md">
                <img src="https://image-tc.galaxy.tf/wijpeg-26ovbzucgz5v7id8lv00pbp/bar-0451-1_standard.jpg?crop=106%2C0%2C1708%2C1281"
                     alt="Descanso Beach Club bar"
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
