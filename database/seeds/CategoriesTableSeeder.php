<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'Fieldwork Equipment']);
        Category::create(['name' => 'Chemicals']);
        Category::create(['name' => 'Laboratory Equipment Set']);
    }
}
