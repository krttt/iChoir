<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultUsersRole extends Migration
{
    /* Before modifying a column, be sure to add the doctrine/dbal dependency to your composer.json file. 
     * The Doctrine DBAL library is used to determine the current state of the column and create the SQL queries 
     * needed to make the specified adjustments to the column: composer require doctrine/dbal
     */
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('role')->unsigned()->default(1)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('role')->unsigned()->default(null)->change();
        });
    }
}
