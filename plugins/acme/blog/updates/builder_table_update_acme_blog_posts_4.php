<?php namespace Acme\Blog\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeBlogPosts4 extends Migration
{
    public function up()
    {
        Schema::table('acme_blog_posts', function($table)
        {
            $table->boolean('is_published')->nullable()->change();
            $table->string('title', 255)->nullable()->default(null)->change();
            $table->string('slug', 255)->nullable()->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('acme_blog_posts', function($table)
        {
            $table->boolean('is_published')->nullable(false)->change();
            $table->string('title', 255)->nullable(false)->default('null')->change();
            $table->string('slug', 255)->nullable(false)->default('null')->change();
        });
    }
}
