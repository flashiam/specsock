<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles_tables', function($table){
            $table->increments('id');
            $table->string('article_id');
            $table->string('category');
            $table->string('on_page');
            $table->string('priority');
            $table->string('asso_art_id');
            $table->string('file_loc');
            $table->string('external_urls');
            $table->timestamp('created_on');
            $table->timestamp('updated_on');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('articles_tables')->dropIfExists();
    }
}
