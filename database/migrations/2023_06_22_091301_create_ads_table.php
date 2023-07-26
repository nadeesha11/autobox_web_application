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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->integer('ad_number');
            $table->string('ad_title');
            $table->string('ad_district');
            $table->string('ad_city');
            $table->text('ad_description');
            $table->double('ad_price');
            $table->integer('ad_view_count');
            $table->dateTime('ad_expire_date');
            $table->smallInteger('status');
            $table->unsignedBigInteger('vehicle_types_id');
            $table->unsignedBigInteger('brands_id');
            $table->unsignedBigInteger('models_id');
            $table->string('ads_condition');
            $table->integer('ads_parts_accessory_type');
            $table->unsignedBigInteger('ads_customers_id');
            $table->integer('is_top_id');
            $table->dateTime('top_ad_expire_date');
            $table->timestamps();

            $table->foreign('vehicle_types_id')
                ->references('id')
                ->on('vehicle_types')
                ->onDelete('cascade');

            $table->foreign('brands_id')
                ->references('id')
                ->on('brand')
                ->onDelete('cascade');

            $table->foreign('models_id')
                ->references('id')
                ->on('model')
                ->onDelete('cascade');

            $table->foreign('ads_customers_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
