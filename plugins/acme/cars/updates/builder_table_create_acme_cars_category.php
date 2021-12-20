<?php namespace Acme\Cars\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAcmeCarsCategory extends Migration
{
    public function up()
    {
        Schema::create('acme_cars_category', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->integer('sort_order')->nullable()->default(1);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('acme_cars_category');
    }
}
