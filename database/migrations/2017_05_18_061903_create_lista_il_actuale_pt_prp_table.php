<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListaIlActualePtPrpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista_il_actuale_pt_prp', function (Blueprint $t) {
            $t->increments('id')->unsigned();
            $t->integer('id_prp')->unsigned()->default(0)->nullable();
            $t->string('nume');
            $t->integer('nr_inventar');
            $t->string('cod');
            $t->string('detalii');
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
        Schema::table('lista_il_actuale_pt_prp', function (Blueprint $t) {
            $t->drop();
        });
    }
}