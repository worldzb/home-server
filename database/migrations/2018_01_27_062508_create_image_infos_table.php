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
            $table->string('imgName');
            $table->string('url');
            $table->string('cosUrl');
            $table->char('addMan',10);
            $table->string('type');
            $table->string('classify');
            $table->string('remark');
            $table->string('liked');
            $table->string('comment');
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
