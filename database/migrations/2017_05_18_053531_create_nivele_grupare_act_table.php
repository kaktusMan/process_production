<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNiveleGrupareActTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('nivele_grupare_act', function (Blueprint $t) {
            $t->increments('id')->unsigned();
            $t->string('nume'); 
            $t->timestamps();
            $t->softDeletes();   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nivele_grupare_act', function (Blueprint $t) {
            $t->drop();
        });
    }
}