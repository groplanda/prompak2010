<?php namespace Acme\Blog\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeBlogCategories6 extends Migration
{
    public function up()
    {
        Schema::table('acme_blog_categories', function($table)
        {
            $table->integer('nest_left')->nullable()->default(0)->change();
            $table->integer('sort_order')->nullable()->change();
            $table->integer('nest_depth')->nullable()->default(0)->change();
            $table->integer('nest_right')->nullable()->default(0)->change();
        });
    }
    
    public function down()
    {
        Schema::table('acme_blog_categories', function($table)
        {
            $table->integer('nest_left')->nullable(false)->default(null)->change();
            $table->integer('sort_order')->nullable(false)->change();
            $table->integer('nest_depth')->nullable(false)->default(null)->change();
            $table->integer('nest_right')->nullable(false)->default(null)->change();
        });
    }
}
