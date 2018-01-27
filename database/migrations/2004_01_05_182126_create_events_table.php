<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();


            $table->text('name');
            $table->date('date')->nullable();
            $table->time('begin_time')->nullable();
            $table->time('end_time')->nullable();
            $table->decimal('price', 5, 2);    
            $table->longText('description');

            $table->boolean('private')->default(0);



            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('cities');  

            $table->integer('choir_id')->unsigned();
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
        Schema::dropIfExists('events');
    }
}
