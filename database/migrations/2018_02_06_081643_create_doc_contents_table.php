<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',100);
            $table->text('content');
            $table->unsignedInteger('bookList_id'); //图书id
            $table->tinyInteger('version');         //章节版本
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
        Schema::dropIfExists('doc_contents');
    }
}
