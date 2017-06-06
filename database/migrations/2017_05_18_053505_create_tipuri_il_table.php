<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipuriIlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipuri_il', function (Blueprint $t) {
            $t->increments('id')->unsigned();
            $t->string('nume');
            $t->integer('id_niv_grupare')->unsigned()->default(0)->nullable();
            $t->integer('id_modalit_realiz')->unsigned()->default(0)->nullable();
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
        Schema::table('tipuri_il', function (Blueprint $t) {
            $t->drop();
        });
    }
}