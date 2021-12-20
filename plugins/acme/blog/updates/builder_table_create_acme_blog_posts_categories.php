<?php namespace Acme\Blog\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAcmeBlogPostsCategories extends Migration
{
    public function up()
    {
        Schema::create('acme_blog_posts_categories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('post_id');
            $table->integer('category_id');
            $table->primary(['post_id','category_id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('acme_blog_posts_categories');
    }
}
