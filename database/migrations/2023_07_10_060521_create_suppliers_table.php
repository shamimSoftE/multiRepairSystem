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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 75);
            $table->string('address');
            $table->string('mobile', 25);
            $table->string('phone', 25)->nullable();
            $table->string('email', 75)->nullable();
            $table->string('web')->nullable();
            $table->string('contact_person')->nullable();
            $table->integer('opening_balance')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
