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
    'date'        => '2026-04-11',   // ISO date, used for countdown & formatting
    'date_pretty' => 'Sunday, April 11th, 2027',
    'time'        => '4:30 in the afternoon',

    /*
    |--------------------------------------------------------------------------
    | Venue
    |--------------------------------------------------------------------------
    */
    'venue' => [
        'name'    => 'Descanso Beach Club',
        'address' => '1 St Catherine Way',
        'city'    => 'Avalon, California',
        'map_url' => 'https://www.google.com/maps/place/Descanso+Beach+Club/@33.3506355,-118.3310889,1371m/data=!3m2!1e3!4b1!4m6!3m5!1s0x80dd77199c77d347:0xe32063b21ee8ef1f!8m2!3d33.3506355!4d-118.328514!16s%2Fg%2F1tctfxwy?entry=ttu&g_ep=EgoyMDI2MDUyMC4wIKXMDSoASAFQAw%3D%3D',
    ],

    /*
    |--------------------------------------------------------------------------
    | RSVP
    |--------------------------------------------------------------------------
    */
    'rsvp_deadline'  => 'Feburary 1st, 2027',
    'max_guests'     => 2,
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
    'admin_password' => env('ADMIN_PASSWORD', 'WeL0v3BlackOlives'),

];
