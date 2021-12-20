<?php namespace Acme\Blog\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeBlogComments extends Migration
{
    public function up()
    {
        Schema::table('acme_blog_comments', function($table)
        {
            $table->boolean('is_published')->nullable()->default(true);
        });
    }
    
    public function down()
    {
        Schema::table('acme_blog_comments', function($table)
        {
            $table->dropColumn('is_published');
        });
    }
}
