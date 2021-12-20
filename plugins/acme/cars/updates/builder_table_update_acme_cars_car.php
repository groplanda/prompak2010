<?php namespace Acme\Cars\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeCarsCar extends Migration
{
    public function up()
    {
        Schema::table('acme_cars_car', function($table)
        {
            $table->integer('sort_order')->nullable()->default(1);
            $table->string('slug')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('acme_cars_car', function($table)
        {
            $table->dropColumn('sort_order');
            $table->dropColumn('slug');
        });
    }
}
