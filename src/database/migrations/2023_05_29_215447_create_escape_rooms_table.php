<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('escape_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('theme');
            $table->integer('maximum_participants');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('escape_rooms');
    }
};
