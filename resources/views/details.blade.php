@extends('layouts.app')

@section('title', 'Wedding Details')

@section('content')
    {{-- Page header --}}
    <section class="relative overflow-hidden flex items-center justify-center"
             style="background-image: url('https://image-tc.galaxy.tf/wijpeg-5xrr5svfs41d9vdogt6fha6vl/cabana-1835.jpg?width=1920'); background-size: cover; background-position: center;">
        <div class="absolute inset-0 bg-lagoon-900/65"></div>
        <div class="relative z-10 mx-auto max-w-3xl px-5 py-20 text-center">
            <p class="text-sm uppercase tracking-[0.3em] text-white/70">Everything you need to know</p>
            <h1 class="mt-4 text-script text-6xl text-white drop-shadow-lg">The Details</h1>
            <p class="mt-4 font-serif text-lg text-white/80">
                Toes in the sand, drinks in hand &mdash; here's how the day will unfold.
            </p>
        </div>
    </section>

    <div class="mx-auto max-w-3xl px-5 py-16 space-y-16">

        {{-- Schedule --}}
        <section>
            <h2 class="text-center font-serif text-4xl text-lagoon-800">Schedule of Events</h2>
            <div class="mt-10 space-y-4">
                @php
                    $schedule = [
                        ['3:30 PM', 'Guest Arrival', 'Grab a welcome drink and find your seat on the sand.'],
                        ['4:00 PM', 'Ceremony', 'Say "I do" as the tide rolls in.'],
                        ['4:30 PM', 'Cocktail Hour', 'Tropical cocktails and ocean views.'],
                        ['6:00 PM', 'Dinner & Toasts', 'A seaside feast under string lights.'],
                        ['8:00 PM', 'Dancing', 'Barefoot on the beach until the stars come out.'],
                    ];
                @endphp
                @foreach ($schedule as [$time, $name, $desc])
                    <div class="flex gap-5 rounded-2xl bg-white p-5 shadow-sm ring-1 ring-sand-200">
                        <div class="w-24 shrink-0 text-lagoon-600 font-semibold">{{ $time }}</div>
                        <div>
                            <h3 class="font-serif text-xl text-lagoon-800">{{ $name }}</h3>
                            <p class="text-lagoon-600">{{ $desc }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- Venue --}}
        <section class="relative overflow-hidden rounded-3xl px-8 py-12 text-center text-white"
                 style="background-image: url('https://image-tc.galaxy.tf/wijpeg-6sr5mqfvzav8ti5x1qt313b8s/aerial-avalon-2-result.jpg?width=1920'); background-size: cover; background-position: center;">
            <div class="absolute inset-0 bg-lagoon-900/60"></div>
            <div class="relative z-10">
                <h2 class="font-serif text-4xl text-white">The Venue</h2>
                <p class="mt-4 text-2xl font-serif">{{ config('wedding.venue.name') }}</p>
                <p class="mt-1 text-lagoon-100">{{ config('wedding.venue.address') }}</p>
                <p class="text-lagoon-100">{{ config('wedding.venue.city') }}</p>
                <a href="{{ config('wedding.venue.map_url') }}" target="_blank" rel="noopener"
                   class="mt-6 inline-block rounded-full bg-lagoon-600 px-7 py-3 text-white font-medium hover:bg-lagoon-700 transition">
                    View on Map
                </a>
            </div>
        </section>

        {{-- Two-up info --}}
        <section class="grid gap-6 sm:grid-cols-2">
            <div class="rounded-3xl bg-white p-8 shadow-sm ring-1 ring-sand-200">
                <h3 class="font-serif text-2xl text-lagoon-800">Travel &amp; Stay</h3>
                <p class="mt-3 text-lagoon-600">
                    A block of rooms is reserved at the resort under "{{ config('wedding.partner_one') }} &amp;
                    {{ config('wedding.partner_two') }}." The nearest airport is about 90 minutes away &mdash;
                    we recommend arriving a day early to settle into island time.
                </p>
            </div>
            <div class="rounded-3xl bg-white p-8 shadow-sm ring-1 ring-sand-200">
                <h3 class="font-serif text-2xl text-lagoon-800">Dress Code</h3>
                <p class="mt-3 text-lagoon-600">
                    Beach formal. Think breezy linens, flowing dresses, and pastel hues. Leave the stilettos
                    behind &mdash; the ceremony is right on the sand, so flats or bare feet are encouraged.
                </p>
            </div>
        </section>

        {{-- FAQ --}}
        <section>
            <h2 class="text-center font-serif text-4xl text-lagoon-800">Good to Know</h2>
            <div class="mt-8 space-y-4">
                @php
                    $faqs = [
                        ['Can I bring a guest?', 'Your invitation will note how many seats we\'ve saved for you. Please let us know on the RSVP.'],
                        ['Is the ceremony outdoors?', 'Yes! Everything takes place beachside. We\'ll have shade, water, and a tent ready just in case.'],
                        ['What about kids?', 'We love your little ones, but this will be an adults-only celebration so everyone can relax.'],
                        ['When should I RSVP?', 'Kindly reply by ' . config('wedding.rsvp_deadline') . ' so we can finalize the headcount.'],
                    ];
                @endphp
                @foreach ($faqs as [$q, $a])
                    <details class="group rounded-2xl bg-white p-5 shadow-sm ring-1 ring-sand-200">
                        <summary class="flex cursor-pointer items-center justify-between font-serif text-xl text-lagoon-800 marker:content-none">
                            {{ $q }}
                            <span class="text-coral-500 transition group-open:rotate-45">+</span>
                        </summary>
                        <p class="mt-3 text-lagoon-600">{{ $a }}</p>
                    </details>
                @endforeach
            </div>
        </section>

        <div class="text-center">
            <a href="{{ route('magic-link.show') }}"
               class="inline-block rounded-full bg-coral-500 px-8 py-3 text-white font-medium shadow-md hover:bg-coral-600 transition">
                RSVP Now
            </a>
        </div>
    </div>
@endsection
