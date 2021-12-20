<?php namespace Acme\Blog\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeBlogPosts7 extends Migration
{
    public function up()
    {
        Schema::table('acme_blog_posts', function($table)
        {
            $table->integer('sort_order');
        });
    }
    
    public function down()
    {
        Schema::table('acme_blog_posts', function($table)
        {
            $table->dropColumn('sort_order');
        });
    }
}
