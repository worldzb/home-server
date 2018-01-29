<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('imgName')->comment('图片名');
            $table->string('url')->comment('可用url');
            $table->string('cosUrl');
            $table->string('addMan',10);
            $table->string('type',5);
            $table->string('classify',10);
            $table->string('remark');
            $table->unsignedInteger('liked');
            $table->unsignedInteger('comment');
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
        Schema::dropIfExists('image_infos');
    }
}
