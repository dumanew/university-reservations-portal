<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create(['item_status' => 'Available']);
        Status::create(['item_status' => 'Unavailable']);
        Status::create(['item_status' => 'Out of Stock']);
    }
}
