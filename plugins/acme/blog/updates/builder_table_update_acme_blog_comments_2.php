<?php namespace Acme\Blog\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeBlogComments2 extends Migration
{
    public function up()
    {
        Schema::table('acme_blog_comments', function($table)
        {
            $table->integer('post_id');
        });
    }
    
    public function down()
    {
        Schema::table('acme_blog_comments', function($table)
        {
            $table->dropColumn('post_id');
        });
    }
}
