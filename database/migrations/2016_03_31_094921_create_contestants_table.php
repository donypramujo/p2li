<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContestantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contestants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contest_id')->unsigned();
            $table->integer('subcategory_id')->unsigned();
            $table->integer('image_id')->unsigned()->nullable();
            $table->integer('team_id')->unsigned();
            $table->foreign('contest_id')->references('id')->on('contests')
            		->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')
            		->onUpdate('restrict')->onDelete('restrict');
            $table->integer('tank_number')->unsigned();
            $table->string('owner',50)->nullable;
            $table->boolean('nomination');
            
            $table->foreign('image_id')->references('id')->on('files')
            		->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('small_image_id')->references('id')->on('files')
            		->onUpdate('restrict')->onDelete('restrict');
            		
            		
            $table->foreign('team_id')->references('id')->on('teams')
            		->onUpdate('restrict')->onDelete('restrict');
            
            		
            		
            $table->unique(['contest_id','tank_number']);
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
        Schema::drop('contestants');
    }
}
