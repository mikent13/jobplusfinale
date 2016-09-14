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
            $table->integer('category_id');            
            $table->string('title');
            $table->string('description');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('schedule_id');
            $table->integer('paytype_id');
            $table->float('salary');
            $table->boolean('is_all_day');
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
