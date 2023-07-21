<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '12345678',
            'password' => '12345678'
        ]);
        Category::factory()->create([
            'name' => "Yangon",
            'image' => "123.png"
        ]);
        Tag::factory()->create([
            'name' => "Hot News",
            'image' => "123.png"
        ]);
    }
}
