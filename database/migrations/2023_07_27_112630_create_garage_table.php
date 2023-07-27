<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('garage', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('city', 30);
            $table->string('number', 20);
            $table->string('url', 3000);
            $table->text('address', 3000);
            $table->text('desc', 3000);
            $table->string('image', 300);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('garage');
    }
};
