<x-mail::message>
# You're Invited!

Dear {{ $invite->name }},

We are so excited to share that we're getting married and we'd love for you to celebrate with us!

**{{ config('wedding.partner_one') }} & {{ config('wedding.partner_two') }}**
{{ config('wedding.date_pretty') }} · {{ config('wedding.time') }}
{{ config('wedding.venue.name') }}, {{ config('wedding.venue.city') }}

Please use the button below to RSVP. Your link is unique to you — no password needed.

<x-mail::button :url="$rsvpUrl">
    RSVP Now
</x-mail::button>

Kindly reply by **{{ config('wedding.rsvp_deadline') }}**.

With love,<br>
{{ config('wedding.partner_one') }} & {{ config('wedding.partner_two') }}
</x-mail::message>
