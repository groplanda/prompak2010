<?php namespace Acme\Cars\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAcmeCarsCar extends Migration
{
    public function up()
    {
        Schema::create('acme_cars_car', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('price')->nullable();
            $table->string('type')->nullable();
            $table->boolean('is_active')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('acme_cars_car');
    }
}
