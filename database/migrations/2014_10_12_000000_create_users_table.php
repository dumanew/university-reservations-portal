<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('user_role');
            $table->rememberToken();
            $table->timestamps();
            $table->tinyInteger('is_archived')->default(0);
        });

        DB::table('users')->insert(
            array(
                'name' => 'Technician (Admin)',
                'email' => 'technician@admin.com',
                'password' => Hash::make('technician'),
                'user_role' => 'admin',
                'is_archived' => 0
            )
        );

        DB::table('users')->insert(
            array(
                'name' => 'Student One',
                'email' => 'student@one.com',
                'password' => Hash::make('student1'),
                'user_role' => 'student',
                'is_archived' => 0
            )
        );

        DB::table('users')->insert(
            array(
                'name' => 'Student Two',
                'email' => 'student@two.com',
                'password' => Hash::make('student2'),
                'user_role' => 'student',
                'is_archived' => 0
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
