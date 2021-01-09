<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesChapterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes_chapter_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('classes_chapter_id')->comment('章节D');
            $table->bigInteger('user_id')->comment('用户ID');

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
        Schema::dropIfExists('classes_chapter_users');
    }
}
