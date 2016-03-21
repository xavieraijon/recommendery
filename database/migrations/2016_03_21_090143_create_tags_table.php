<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 60);
            $table->integer('tag_group_id')->unsigned();
            $table->foreign('tag_group_id')->references('id')->on('tag_groups')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        /**
         * Taula Pivot entre Tags i Users.
         */
        Schema::create('tag_user', function (Blueprint $table) {
            $table->integer('tag_id')->unsigned()->index();
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('frequency')->unsigned();
        });

        /**
         * Taula Pivot entre Tags i Users.
         */
        Schema::create('restaurant_tag', function (Blueprint $table) {
            $table->integer('restaurant_id')->unsigned()->index();
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');

            $table->integer('tag_id')->unsigned()->index();
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

            $table->integer('frequency')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tags');
        Schema::drop('tag_user');
        Schema::drop('restaurant_tag');
    }
}
