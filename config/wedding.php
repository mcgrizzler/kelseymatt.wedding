<?php

return [

    /*
    |--------------------------------------------------------------------------
    | The Couple
    |--------------------------------------------------------------------------
    | Edit these to change the names shown across the whole site.
    */
    'partner_one' => 'Kelsey',
    'partner_two' => 'Matt',

    /*
    |--------------------------------------------------------------------------
    | Date & Time
    |--------------------------------------------------------------------------
    */
    'date'        => '2026-09-12',   // ISO date, used for countdown & formatting
    'date_pretty' => 'Saturday, September 12th, 2026',
    'time'        => '4:00 in the afternoon',

    /*
    |--------------------------------------------------------------------------
    | Venue
    |--------------------------------------------------------------------------
    */
    'venue' => [
        'name'    => 'Descanso Beach Club',
        'address' => '1 St Catherine Way',
        'city'    => 'Avalon, California',
        'map_url' => 'https://maps.google.com/?q=Avalon',
    ],

    /*
    |--------------------------------------------------------------------------
    | RSVP
    |--------------------------------------------------------------------------
    */
    'rsvp_deadline'  => 'August 1st, 2026',
    'max_guests'     => 6,
    'meal_options'   => [
        'Grilled Mahi-Mahi',
        'Island Jerk Chicken',
        'Coconut Curry (Vegetarian)',
        'Garden Vegan Plate',
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin
    |--------------------------------------------------------------------------
    | Password used to view the private RSVP dashboard. Set ADMIN_PASSWORD
    | in your .env file. Defaults to a placeholder for local development.
    */
    'admin_password' => env('ADMIN_PASSWORD', 'changeme'),

];
