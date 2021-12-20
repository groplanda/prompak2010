<?php namespace Acme\Blog\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeBlogPosts9 extends Migration
{
    public function up()
    {
        Schema::table('acme_blog_posts', function($table)
        {
            $table->integer('nest_left')->nullable()->change();
            $table->integer('sort_order')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('acme_blog_posts', function($table)
        {
            $table->integer('nest_left')->nullable(false)->change();
            $table->integer('sort_order')->nullable(false)->change();
        });
    }
}
