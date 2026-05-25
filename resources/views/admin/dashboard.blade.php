<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RSVP Dashboard · {{ config('wedding.partner_one') }} &amp; {{ config('wedding.partner_two') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-sand-50 font-sans text-lagoon-900">

    <header class="border-b border-sand-200 bg-white">
        <div class="mx-auto max-w-6xl px-5 h-16 flex items-center justify-between">
            <h1 class="text-script text-3xl text-lagoon-700">RSVP Dashboard</h1>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="text-sm text-lagoon-600 hover:text-coral-500 transition">Sign out</button>
            </form>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-5 py-10">

        {{-- Stats --}}
        <div class="grid gap-4 sm:grid-cols-4">
            @php
                $tiles = [
                    ['Responses', $stats['responses'], 'text-lagoon-700'],
                    ['Attending', $stats['attending'], 'text-palm-600'],
                    ['Declined', $stats['declined'], 'text-coral-500'],
                    ['Total Headcount', $stats['head_count'], 'text-lagoon-700'],
                ];
            @endphp
            @foreach ($tiles as [$label, $value, $color])
                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-sand-200">
                    <p class="text-xs uppercase tracking-widest text-lagoon-500">{{ $label }}</p>
                    <p class="mt-2 text-3xl font-serif font-semibold {{ $color }}">{{ $value }}</p>
                </div>
            @endforeach
        </div>

        {{-- Table --}}
        <div class="mt-10 overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-sand-200">
            <div class="flex items-center justify-between px-6 py-4 border-b border-sand-200">
                <h2 class="font-serif text-xl text-lagoon-800">All Responses</h2>
                <a href="{{ route('admin.dashboard', ['export' => 'csv']) }}"
                   class="text-sm text-coral-500 hover:text-coral-600 transition">Export CSV</a>
            </div>

            @if ($rsvps->isEmpty())
                <p class="px-6 py-12 text-center text-lagoon-500">No RSVPs yet. Once guests reply, they'll appear here.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-sand-50 text-xs uppercase tracking-wider text-lagoon-500">
                            <tr>
                                <th class="px-6 py-3">Name</th>
                                <th class="px-6 py-3">Email</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Guests</th>
                                <th class="px-6 py-3">Meal</th>
                                <th class="px-6 py-3">Dietary notes</th>
                                <th class="px-6 py-3">Submitted</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-sand-100">
                            @foreach ($rsvps as $rsvp)
                                <tr class="hover:bg-sand-50">
                                    <td class="px-6 py-3 font-medium text-lagoon-800">{{ $rsvp->name }}</td>
                                    <td class="px-6 py-3 text-lagoon-600">{{ $rsvp->email ?: '—' }}</td>
                                    <td class="px-6 py-3">
                                        @if ($rsvp->attending)
                                            <span class="rounded-full bg-palm-500/15 px-2.5 py-1 text-xs font-medium text-palm-600">Attending</span>
                                        @else
                                            <span class="rounded-full bg-coral-300/30 px-2.5 py-1 text-xs font-medium text-coral-600">Declined</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-3 text-lagoon-600">{{ $rsvp->attending ? $rsvp->number_of_guests : '—' }}</td>
                                    <td class="px-6 py-3 text-lagoon-600">{{ $rsvp->meal_choice ?: '—' }}</td>
                                    <td class="px-6 py-3 text-lagoon-600">{{ $rsvp->dietary_restrictions ?: '—' }}</td>
                                    <td class="px-6 py-3 text-lagoon-500">{{ $rsvp->created_at->format('M j, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </main>
</body>
</html>
