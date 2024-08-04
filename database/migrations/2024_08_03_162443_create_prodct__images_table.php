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
        Schema::create('prodct__images', function (Blueprint $table) {
            $table->id();
            $table->integer('prodcut_id')->nullable();
            $table->string('image_name')->nullable();
            $table->string('image_extension')->nullable();
            $table->integer('order_by')->nullable()->default(100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodct__images');
    }
};
