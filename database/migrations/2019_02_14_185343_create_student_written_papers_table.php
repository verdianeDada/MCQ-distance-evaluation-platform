<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentWrittenPapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_written_papers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mark');

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('test_paper_id');
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
        Schema::dropIfExists('student_written_papers');
    }
}
