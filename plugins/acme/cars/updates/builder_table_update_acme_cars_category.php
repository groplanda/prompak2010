<?php namespace Acme\Cars\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeCarsCategory extends Migration
{
    public function up()
    {
        Schema::table('acme_cars_category', function($table)
        {
            $table->text('description')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('acme_cars_category', function($table)
        {
            $table->dropColumn('description');
        });
    }
}
