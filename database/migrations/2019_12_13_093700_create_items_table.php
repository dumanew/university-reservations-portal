<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 150);
            $table->longText('description');
            $table->string('image_location', 200);
            $table->timestamps();
            $table->unsignedBigInteger('quantity')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('status_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->tinyInteger('is_archived')->default(0);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
