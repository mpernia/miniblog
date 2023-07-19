<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('tag_id');

            $table->foreign('post_id', 'post_id_fk_23071183')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');
            $table->foreign('tag_id', 'tag_id_fk_23071184')
                ->references('id')
                ->on('tags')
                ->onDelete('cascade');
        });
    }
};
