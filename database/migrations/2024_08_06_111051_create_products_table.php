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
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('product_gambar')->nullable();
            $table->string('product_nama', 32);
            $table->string('product_kategori', 20);
            $table->integer('product_harga');
            $table->text('product_deskripsi');
            $table->string('status_publish', 5)->default('N'); // default to 'N' (not published)
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
