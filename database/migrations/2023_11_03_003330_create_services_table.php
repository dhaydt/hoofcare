<?php

use App\Models\Service;
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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->timestamps();
        });

        Service::create([
            'name' => 'Metal shoeing'
        ]);
        Service::create([
            'name' => 'Barefoot trim'
        ]);
        Service::create([
            'name' => 'Rehab trim'
        ]);
        Service::create([
            'name' => 'Gluing'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
