<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('name',20)->unique();
            $table->decimal('rate_overall_impression',5,2)->unsigned();
            $table->decimal('rate_head',5,2)->unsigned();
            $table->decimal('rate_face',5,2)->unsigned();
            $table->decimal('rate_body_shape',5,2)->unsigned();
            $table->decimal('rate_marking',5,2)->unsigned();
            $table->decimal('rate_pearl',5,2)->unsigned();
            $table->decimal('rate_color',5,2)->unsigned();
            $table->decimal('rate_finnage',5,2)->unsigned();
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
        Schema::drop('categories');
    }
}
