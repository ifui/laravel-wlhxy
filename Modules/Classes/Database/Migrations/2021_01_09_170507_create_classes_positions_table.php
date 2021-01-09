<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes_positions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('classes_course_id')->comment('课程表ID');
            $table->string('title')->comment('推荐名');
            $table->string('thumb')->comment('缩略图')->nullable();
            $table->tinyInteger('order')->default(0)->comment('排序');
            $table->tinyInteger('status')->default(1)->comment('状态 0禁用 1:正常');

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
        Schema::dropIfExists('classes_positions');
    }
}
