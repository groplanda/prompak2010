<?php namespace Acme\Blog\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeBlogPosts3 extends Migration
{
    public function up()
    {
        Schema::table('acme_blog_posts', function($table)
        {
            $table->string('title')->nullable(false)->default('null')->change();
            $table->string('slug')->nullable(false)->default('null')->change();
        });
    }
    
    public function down()
    {
        Schema::table('acme_blog_posts', function($table)
        {
            $table->string('title')->nullable()->default(null)->change();
            $table->string('slug')->nullable()->default(null)->change();
        });
    }
}
