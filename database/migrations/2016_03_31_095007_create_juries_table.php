<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJuriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contest_id')->unsigned();
            $table->integer('user_id')->unsigned();
           	$table->foreign('contest_id')->references('id')->on('contests')
            		->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('users')
            		->onUpdate('restrict')->onDelete('restrict');
            
            		
            $table->unique(['contest_id','user_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('juries');
    }
}
