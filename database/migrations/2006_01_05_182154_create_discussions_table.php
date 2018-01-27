<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscussionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();


            $table->text('topic');
            $table->longText('text');


            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users'); 
         
            $table->boolean('private')->default(0);

            $table->integer('choir_id')->unsigned()->nullable();
            $table->foreign('choir_id')->references('id')->on('choirs'); 


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discussions');
    }
}
