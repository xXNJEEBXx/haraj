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
        Schema::create('accounts_and_thire_ads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone_number')->nullable();
            $table->string('name')->nullable();
            $table->integer('status')->nullable();
            $table->string('ad1_time')->nullable();
            $table->string('ad2_time')->nullable();
            $table->string('ad3_time')->nullable();
            $table->string('ad1_last_update')->nullable();
            $table->string('ad2_last_update')->nullable();
            $table->string('ad3_last_update')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts_and_thire_ads');
    }
};
