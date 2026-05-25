<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rsvp extends Model
{
    protected $fillable = [
        'name',
        'email',
        'attending',
        'number_of_guests',
        'meal_choice',
        'dietary_restrictions',
    ];

    protected $casts = [
        'attending' => 'boolean',
    ];
}
