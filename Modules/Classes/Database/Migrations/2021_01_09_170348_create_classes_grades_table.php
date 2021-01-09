<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes_grades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('年级名');
            $table->string('remark')->comment('备注')->nullable();
            $table->string('color')->comment('颜色');
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
        Schema::dropIfExists('classes_grades');
    }
}
