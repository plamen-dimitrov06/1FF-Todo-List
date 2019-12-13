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

            $table->string('title',50);
            $table->dateTime('deadline');
            $table->boolean('active')
                    ->default(true);
            $table->boolean('completed')
                    ->default(false);
            $table->unsignedInteger('todo_list_id');
            $table->foreign('todo_list_id')
                    ->references('id')
                    ->on('todo_lists');

            $table->timestamps();
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
