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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string("package_name");
            $table->integer("package_ad_count");
            $table->integer("package_duration");
            $table->float("package_price");
            $table->smallInteger("status");
            $table->unsignedBigInteger("category_id");
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('ad_category')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
