<?php namespace Acme\Cars\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeCarsCar2 extends Migration
{
    public function up()
    {
        Schema::table('acme_cars_car', function($table)
        {
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->dropColumn('type');
        });
    }
    
    public function down()
    {
        Schema::table('acme_cars_car', function($table)
        {
            $table->dropColumn('seo_title');
            $table->dropColumn('seo_description');
            $table->string('type', 191)->nullable();
        });
    }
}
