<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListaIlPtAnalizaOptimizFpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista_il_pt_analiza_optimiz_fp', function (Blueprint $t) {
            $t->increments('id')->unsigned();
            $t->integer('id_fl')->unsigned()->default(0)->nullable();
            $t->string('nume');
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
        Schema::table('lista_il_pt_analiza_optimiz_fp', function (Blueprint $t) {
            $t->drop();
        });
    }
}