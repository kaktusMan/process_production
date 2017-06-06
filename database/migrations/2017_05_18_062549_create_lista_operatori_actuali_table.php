<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListaOperatoriActualiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista_operatori_actuali', function (Blueprint $t) {
            $t->increments('id')->unsigned();
            $t->integer('id_pp')->unsigned()->default(0)->nullable();
            $t->string('nume');
            $t->integer('id_tip_op')->unsigned()->default(0)->nullable();
            $t->integer('varsta');
            $t->integer('sex')->comment('0-M;1-F');
            $t->integer('stare_civila');
            $t->float('salar_brut');
            $t->dateTime('data_angajarii');
            $t->string('nivel_performanta');
            $t->float('val_bonuri_de_masa');
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
        Schema::table('lista_operatori_actuali', function (Blueprint $t) {
            $t->drop();
        });
    }
}
