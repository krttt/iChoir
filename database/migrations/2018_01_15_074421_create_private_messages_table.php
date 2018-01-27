<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrivateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('private_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('subject');
            $table->text('message');
            $table->boolean('read');

            $table->integer('sender_id')->unsigned();
            $table->foreign('sender_id')->references('id')->on('users'); 

            $table->integer('receiver_id')->unsigned();
            $table->foreign('receiver_id')->references('id')->on('users'); 

            $table->index('sender_id');
            $table->index('receiver_id');
            $table->index(['sender_id', 'read']);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('private_messages');
    }
}
