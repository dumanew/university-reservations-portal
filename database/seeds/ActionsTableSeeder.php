<?php

use Illuminate\Database\Seeder;
use App\Action;

class ActionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Action::create(['action' => 'Approved']);
        Action::create(['action' => 'Denied']);
        Action::create(['action' => 'Pending']);
        Action::create(['action' => 'Returned']);
    }
}
