<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKnowledgeCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knowledge_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique()->comment('分类名');
            $table->smallInteger('order')->default(0)->comment('排序');
            $table->tinyInteger('status')->default(1)->comment('状态 1 启用 0 禁用');
            $table->nestedSet();
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
        Schema::dropIfExists('knowledge_categories');
    }
}
