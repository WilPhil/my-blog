<?php

namespace Database\Seeders;

use App\Models\Category;
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
            'name' => 'General',
            'slug' => 'general',
            'color' => '#f1f5f9',
        ]);

        Category::factory()->create([
            'name' => 'Web Programming',
            'slug' => 'web-programming',
            'color' => '#dcfce7',
        ]);

        Category::factory()->create([
            'name' => 'Artificial Intelligence',
            'slug' => 'ai',
            'color' => '#e0e7ff',
        ]);

        Category::factory()->create([
            'name' => 'UI/UX',
            'slug' => 'ui-ux',
            'color' => '#ffedd4',
        ]);
    }
}
