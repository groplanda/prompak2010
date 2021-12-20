<?php namespace Acme\Contactform\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeContactform extends Migration
{
    public function up()
    {
        Schema::table('acme_contactform_', function($table)
        {
            $table->string('user_mail', 255)->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('acme_contactform_', function($table)
        {
            $table->dropColumn('user_mail');
        });
    }
}
