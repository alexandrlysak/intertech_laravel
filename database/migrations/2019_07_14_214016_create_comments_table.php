<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id')->nullable()->comment('Comment parent id');
            $table->text('content')->nullable()->comment('Comment content');
            $table->timestamps();

            $table->unsignedBigInteger('author_id')->nullable()->comment('Comment author id');
            $table->foreign('author_id')->references('id')->on('users');

            $table->unsignedBigInteger('post_id')->nullable()->comment('Comment post id');
            $table->foreign('post_id')->references('id')->on('posts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
