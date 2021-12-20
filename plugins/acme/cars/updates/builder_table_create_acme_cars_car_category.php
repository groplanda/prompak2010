<?php namespace Acme\Cars\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAcmeCarsCarCategory extends Migration
{
    public function up()
    {
        Schema::create('acme_cars_car_category', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('car_id');
            $table->integer('category_id');
            $table->primary(['car_id','category_id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('acme_cars_car_category');
    }
}
