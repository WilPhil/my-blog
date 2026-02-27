<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Category::factory()->create([
            'name' => 'Web Programming',
            'slug' => 'web-programming',
            'color' => 'bg-green-100'
        ]);

        Category::factory()->create([
            'name' => 'Artificial Intelligence',
            'slug' => 'ai',
            'color' => 'bg-indigo-100'
        ]);

        Category::factory()->create([
            'name' => 'UI/UX',
            'slug' => 'ui-ux',
            'color' => 'bg-orange-100'
        ]);
    }
}
