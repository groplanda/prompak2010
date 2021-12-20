<?php namespace Acme\Blog\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAcmeBlogCategories extends Migration
{
    public function up()
    {
        Schema::create('acme_blog_categories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 255);
            $table->string('slug', 255);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('acme_blog_categories');
    }
}
