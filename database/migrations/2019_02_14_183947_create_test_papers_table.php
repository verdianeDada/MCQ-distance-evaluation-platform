<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestPapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_papers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->dateTime('start_time');
            $table->time('duration');
            $table->integer('over_mark');
            
            $table->unsignedInteger('course_id');
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
        Schema::dropIfExists('test_papers');
    }
}
