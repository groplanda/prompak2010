<?php namespace Acme\Blog\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeBlogComments4 extends Migration
{
    public function up()
    {
        Schema::table('acme_blog_comments', function($table)
        {
            $table->integer('nest_depth');
        });
    }
    
    public function down()
    {
        Schema::table('acme_blog_comments', function($table)
        {
            $table->dropColumn('nest_depth');
        });
    }
}
