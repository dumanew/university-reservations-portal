<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWagonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wagons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('date_borrowed');
            $table->dateTime('date_denied')->nullable();
            $table->dateTime('date_approved')->nullable();
            $table->dateTime('date_returned')->nullable();
            $table->unsignedBigInteger('quantity');  
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('user_id'); 
            $table->unsignedBigInteger('category_id'); 
            $table->unsignedBigInteger('status_id');        
            $table->unsignedBigInteger('action_id');        
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('action_id')->references('id')->on('actions');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
