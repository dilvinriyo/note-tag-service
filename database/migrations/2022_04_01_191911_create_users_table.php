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
            $table->id();
            $table->string('full_name', 20);
            $table->string('email', 30)->unique();  // add unique key for email column
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams'); // add fk relation for team_id column
            $table->boolean('status')->default(1);  // default is 1 for status column
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
