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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('ulasan_id');
            $table->unsignedBigInteger('customer_id');
            $table->integer('ulasan_rating');
            $table->text('ulasan_deskripsi');
            $table->timestamps();
            $table->softDeletes();

             // Add foreign key constraints
             $table->foreign('customer_id')->references('customer_id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review');
    }
};
