<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('category_post', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('category_id');

            $table->foreign('post_id', 'post_id_fk_23071181')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');
            $table->foreign('category_id', 'category_id_fk_23071182')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });
    }
};
