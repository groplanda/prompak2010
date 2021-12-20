<?php namespace Acme\Blog\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeBlogPosts2 extends Migration
{
    public function up()
    {
        Schema::table('acme_blog_posts', function($table)
        {
            $table->boolean('is_published')->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('acme_blog_posts', function($table)
        {
            $table->dropColumn('is_published');
        });
    }
}
