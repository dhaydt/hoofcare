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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('f_name', 100);
            $table->string('l_name', 100)->nullable();
            $table->string('business_name', 200)->nullable();
            $table->string('zipcode', 100);
            $table->string('country', 100);
            $table->string('services', 100)->nullable();
            $table->string('certifications', 100)->nullable();
            $table->string('online_link_1', 500)->nullable();
            $table->string('online_link_2', 500)->nullable();
            $table->string('preferred_contact_method', 500)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('text', 500)->nullable();
            $table->string('messenger', 500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
