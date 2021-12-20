<?php namespace Acme\Blog\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeBlogCategories2 extends Migration
{
    public function up()
    {
        Schema::table('acme_blog_categories', function($table)
        {
            $table->integer('nest_left');
            $table->integer('sort_order');
        });
    }
    
    public function down()
    {
        Schema::table('acme_blog_categories', function($table)
        {
            $table->dropColumn('nest_left');
            $table->dropColumn('sort_order');
        });
    }
}
