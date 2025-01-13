<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CuisineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cuisineName = \App\Models\Cuisine::all()->pluck('name');
        foreach($cuisineName as $name)
        {
            $hcc = \App\Models\Cuisine::whereName($name)->first();
            $hcc->update([
                'slug' => \Illuminate\Support\Str::slug($name)
            ]);
        }
    }
}
