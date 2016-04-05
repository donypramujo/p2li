<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contestant_id')->unsigned();
            $table->integer('jury_id')->unsigned();
            
            $table->foreign('contestant_id')->references('id')->on('contestants')
            		->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('jury_id')->references('id')->on('juries')
            		->onUpdate('restrict')->onDelete('restrict');
            
            $table->decimal('rate_overall_impression',5,2)->unsigned();
            $table->decimal('rate_head',5,2)->unsigned();
            $table->decimal('rate_face',5,2)->unsigned();
            $table->decimal('rate_body_shape',5,2)->unsigned();
            $table->decimal('rate_marking',5,2)->unsigned();
            $table->decimal('rate_pearl',5,2)->unsigned();
            $table->decimal('rate_color',5,2)->unsigned();
            $table->decimal('rate_finnage',5,2)->unsigned();
            $table->decimal('score_overall_impression',12,2)->unsigned();
            $table->decimal('score_head',12,2)->unsigned();
            $table->decimal('score_face',12,2)->unsigned();
            $table->decimal('score_body_shape',12,2)->unsigned();
            $table->decimal('score_marking',12,2)->unsigned();
            $table->decimal('score_pearl',12,2)->unsigned();
            $table->decimal('score_color',12,2)->unsigned();
            $table->decimal('score_finnage',12,2)->unsigned();
            $table->decimal('score_final',12,2)->unsigned();
            
            $table->boolean('valid');
            $table->enum('penalty_type', ['minor','major','']);
            $table->decimal('rate_penalty',5,2)->unsigned();
            $table->decimal('score_penalty',12,2)->unsigned();
            $table->string('comment',20);
            
            $table->unique(['contestant_id','jury_id']);
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
        Schema::drop('scores');
    }
}
