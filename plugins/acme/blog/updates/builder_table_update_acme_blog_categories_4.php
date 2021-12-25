<?php namespace Acme\Blog\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeBlogCategories4 extends Migration
{
    public function up()
    {
        Schema::table('acme_blog_categories', function($table)
        {
            $table->integer('nest_right');
        });
    }
    
    public function down()
    {
        Schema::table('acme_blog_categories', function($table)
        {
            $table->dropColumn('nest_right');
        });
    }
}
