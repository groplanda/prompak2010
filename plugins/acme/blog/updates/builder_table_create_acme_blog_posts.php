<?php namespace Acme\Blog\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAcmeBlogPosts extends Migration
{
    public function up()
    {
        Schema::create('acme_blog_posts', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 255)->nullable();
            $table->text('content')->nullable();
            $table->string('poster', 255)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('acme_blog_posts');
    }
}
