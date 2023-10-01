<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Config;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Item::factory(72)->create();
        DB::table('configs')->delete();

        $config = [
            [
            "title" => 'web_name',
            "value" => 'hoofcare',
            ],
            [
            "title" => 'address',
            "value" => 'Street name, city',
            ],
            [
            "title" => 'country',
            "value" => 'USA',
            ],
            [
            "title" => 'email',
            "value" => 'email@mail.com',
            ],
            [
            "title" => 'phone',
            "value" => '123456',
            ],
            [
            "title" => 'web_logo',
            "value" => '123456',
            ],
        ];

        Config::insert($config);
        
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
