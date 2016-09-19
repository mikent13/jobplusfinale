<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('category');            
            $table->string('title');
            $table->string('description');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('paytype');
            $table->float('salary');
            $table->boolean('is_all_day');
            $table->integer('slot');
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
        Schema::drop('jobs');
    }
}
