<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class dataProduct extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for ($i=0; $i < 5; $i++) { 
           Category::query()->create([
            'name'=>fake()->name() .$i
           ]);
        }
        for ($i=0; $i < 5; $i++) { 
            Tag::query()->create([
                'name'=>fake()->name() .$i
               ]);
        }
    }
}
