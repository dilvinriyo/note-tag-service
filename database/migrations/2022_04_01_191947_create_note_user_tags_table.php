<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoteUserTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('note_user_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('note_id');
            $table->foreign('note_id')->references('id')->on('notes')->onDelete('cascade');; // add fk relation for note_id column with cascade on delete
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');; // add fk relation for user_id column with cascade on delete
            $table->unique(['note_id','user_id']); // add multiple column combination unique for with note_id and user_id
            $table->boolean('status')->default(1); // default is 1 for status column
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
        Schema::dropIfExists('note_user_tags');
    }
}
