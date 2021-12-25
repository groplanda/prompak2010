<?php namespace Acme\Blog\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeBlogCategories5 extends Migration
{
    public function up()
    {
        Schema::table('acme_blog_categories', function($table)
        {
            $table->integer('sort_order')->default(0)->change();
        });
    }
    
    public function down()
    {
        Schema::table('acme_blog_categories', function($table)
        {
            $table->integer('sort_order')->default(null)->change();
        });
    }
}
