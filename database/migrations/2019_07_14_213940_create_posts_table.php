<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title',255)->nullable()->comment('Post title');
            $table->string('thumbnail',255)->nullable()->comment('Post thumbnail');
            $table->text('shortDescription')->nullable()->comment('Post short description');
            $table->text('fullDescription')->nullable()->comment('Post full description');
            $table->string('slug',255)->nullable()->comment('Post slug');
            $table->unsignedInteger('views')->nullable()->default(0)->comment('Post views count');
            $table->unsignedInteger('likes')->nullable()->default(0)->comment('Post likes count');

            $table->timestamps();

            $table->unsignedBigInteger('author_id')->nullable()->comment('Post author id');
            $table->foreign('author_id')->references('id')->on('users');

            $table->unsignedBigInteger('category_id')->nullable()->comment('Post category id');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
