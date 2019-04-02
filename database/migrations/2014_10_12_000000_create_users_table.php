<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->integer('phone')->unique();
            $table->string('password');
            $table->boolean('isAllowed')->default(true);
            $table->boolean('sex');     //false for male and true for female
            $table->boolean('isAdmin')->default(false);
            $table->boolean('isTeacher')->default(false);
            $table->boolean('option')->nullable();  //false for computer science and true for ICT
            $table->string('matricule')->unique()->nullable();
            $table->integer('year')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
