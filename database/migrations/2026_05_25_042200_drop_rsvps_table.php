<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('rsvps');
    }

    public function down(): void
    {
        Schema::create('rsvps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->boolean('attending')->default(true);
            $table->tinyInteger('number_of_guests')->unsigned()->default(1);
            $table->string('meal_choice')->nullable();
            $table->text('dietary_restrictions')->nullable();
            $table->timestamps();
        });
    }
};
