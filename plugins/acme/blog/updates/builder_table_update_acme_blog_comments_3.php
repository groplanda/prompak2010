<?php namespace Acme\Blog\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeBlogComments3 extends Migration
{
    public function up()
    {
        Schema::table('acme_blog_comments', function($table)
        {
            $table->integer('sort_order');
            $table->integer('nest_left');
        });
    }
    
    public function down()
    {
        Schema::table('acme_blog_comments', function($table)
        {
            $table->dropColumn('sort_order');
            $table->dropColumn('nest_left');
        });
    }
}
