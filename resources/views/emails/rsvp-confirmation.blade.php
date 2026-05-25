<x-mail::message>
@if ($invite->rsvp_status->value === 'confirmed')
# We'll see you there! 🎉

Dear {{ $invite->name }},

We're so excited — your RSVP is confirmed! Here's a summary of your party:

@foreach ($invite->guests as $guest)
- **{{ $guest->name }}** — {{ $guest->meal_choice }}{{ $guest->dietary_restrictions ? ' *('. $guest->dietary_restrictions .')*' : '' }}
@endforeach

**{{ config('wedding.partner_one') }} & {{ config('wedding.partner_two') }}**
{{ config('wedding.date_pretty') }} · {{ config('wedding.time') }}
{{ config('wedding.venue.name') }}, {{ config('wedding.venue.city') }}

@else
# Thank you for letting us know

Dear {{ $invite->name }},

We're sorry you won't be able to make it, but we appreciate you letting us know. You'll be missed!

@endif
Need to make a change before **{{ config('wedding.rsvp_deadline') }}**? Use the button below to update your response.

<x-mail::button :url="$editUrl">
    Update My RSVP
</x-mail::button>

With love,<br>
{{ config('wedding.partner_one') }} & {{ config('wedding.partner_two') }}
</x-mail::message>
