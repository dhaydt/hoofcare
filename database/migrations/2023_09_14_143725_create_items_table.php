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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->text('online_link')->nullable();
            $table->string('pic1', 255)->nullable();
            $table->string('pic2', 255)->nullable();
            $table->string('pic3', 255)->nullable();
            $table->string('pic4', 255)->nullable();
            $table->string('pic5', 255)->nullable();
            $table->string('file_link1', 255)->nullable();
            $table->string('file_link2', 255)->nullable();
            $table->text('credit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
