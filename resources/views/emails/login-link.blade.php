<x-mail::message>
# Your RSVP Link

Hi {{ $invite->name }},

You requested a link to access your RSVP for our wedding on **{{ config('wedding.date_pretty') }}**.

Click the button below to view or update your response:

<x-mail::button :url="$rsvpUrl">
    View My RSVP
</x-mail::button>

This link is unique to you. If you didn't request this, you can safely ignore this email.

With love,<br>
{{ config('wedding.partner_one') }} & {{ config('wedding.partner_two') }}
</x-mail::message>
