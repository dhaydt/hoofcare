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
            $table->string('title', 200);
            $table->string('image', 300)->nullable();
            $table->text('description')->nullable();
            $table->string('show_in', 1000)->default('[]');
            $table->tinyInteger('status')->default(1);
            $table->dateTime('start_at')->default(now());
            $table->dateTime('end_at')->default(now());
            $table->timestamps();
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
