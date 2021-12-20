<?php namespace Acme\Blog\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeBlogPosts8 extends Migration
{
    public function up()
    {
        Schema::table('acme_blog_posts', function($table)
        {
            $table->string('seo_description', 255)->nullable();
            $table->string('seo_keywords', 255)->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('acme_blog_posts', function($table)
        {
            $table->dropColumn('seo_description');
            $table->dropColumn('seo_keywords');
        });
    }
}
