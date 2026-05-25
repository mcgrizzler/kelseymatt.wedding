<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $p1 = config('wedding.partner_one');
        $p2 = config('wedding.partner_two');
    @endphp

    <title>@yield('title', "$p1 & $p2") · {{ config('wedding.date_pretty') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-sand-50 font-sans text-lagoon-900 antialiased flex flex-col">

    <header class="sticky top-0 z-30 backdrop-blur bg-sand-50/80 border-b border-sand-200/70">
        <nav class="mx-auto max-w-5xl px-5 h-16 flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-script text-3xl text-lagoon-700 leading-none">
                {{ $p1[0] }}&nbsp;&amp;&nbsp;{{ $p2[0] }}
            </a>
            <div class="flex items-center gap-6 text-sm font-medium tracking-wide uppercase">
                <a href="{{ route('home') }}"
                   class="hover:text-coral-500 transition {{ request()->routeIs('home') ? 'text-coral-500' : 'text-lagoon-700' }}">Home</a>
                <a href="{{ route('details') }}"
                   class="hover:text-coral-500 transition {{ request()->routeIs('details') ? 'text-coral-500' : 'text-lagoon-700' }}">Details</a>
                <a href="{{ route('magic-link.show') }}"
                   class="rounded-full bg-coral-500 px-4 py-2 text-white shadow-sm hover:bg-coral-600 transition">RSVP</a>
            </div>
        </nav>
    </header>

    <main class="flex-1">
        @yield('content')
    </main>

    <footer class="relative mt-auto">
        <svg class="block w-full text-lagoon-700" viewBox="0 0 1440 120" preserveAspectRatio="none" aria-hidden="true">
            <path fill="currentColor"
                  d="M0,64 C240,128 480,0 720,32 C960,64 1200,128 1440,64 L1440,120 L0,120 Z"></path>
        </svg>
        <div class="bg-lagoon-700 text-lagoon-100 text-center px-5 pb-10 -mt-px">
            <p class="text-script text-4xl text-white">{{ $p1 }} &amp; {{ $p2 }}</p>
            <p class="mt-2 text-sm tracking-widest uppercase">{{ config('wedding.date_pretty') }}</p>
            <p class="mt-1 text-sm text-lagoon-200">{{ config('wedding.venue.name') }} · {{ config('wedding.venue.city') }}</p>
        </div>
    </footer>

</body>
</html>
