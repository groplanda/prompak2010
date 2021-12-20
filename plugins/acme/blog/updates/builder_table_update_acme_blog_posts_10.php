<?php namespace Acme\Blog\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeBlogPosts10 extends Migration
{
    public function up()
    {
        Schema::table('acme_blog_posts', function($table)
        {
            $table->integer('nest_depth')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('acme_blog_posts', function($table)
        {
            $table->dropColumn('nest_depth');
        });
    }
}
