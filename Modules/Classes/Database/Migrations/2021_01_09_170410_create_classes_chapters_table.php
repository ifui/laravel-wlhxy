<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes_chapters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('classes_course_id')->comment('课程表ID');
            $table->string('title')->comment('标题');
            $table->string('description')->comment('简介')->nullable();
            $table->decimal('price')->default(0)->comment('价格');
            $table->string('thumb')->comment('缩略图')->nullable();
            $table->smallInteger('time')->default(0)->comment('用时(单位分钟)');
            $table->tinyInteger('order')->default(0)->comment('排序');
            $table->tinyInteger('status')->default(1)->comment('状态 0禁用 1:正常');

            $table->softDeletes();
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
        Schema::dropIfExists('classes_chapters');
    }
}
