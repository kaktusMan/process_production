<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListaInstrumenteDeLucruTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista_instrumente_de_lucru_posibile', function (Blueprint $t) {
            $t->increments('id')->unsigned();
            $t->integer('id_tip_il')->unsigned()->default(0)->nullable();
            $t->string('nume');
            $t->string('furnizor');
            $t->string('marca');
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
        Schema::table('lista_instrumente_de_lucru_posibile', function (Blueprint $t) {
            $t->drop();
        });
    }
}