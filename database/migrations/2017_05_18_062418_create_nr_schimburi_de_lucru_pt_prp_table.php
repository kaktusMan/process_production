<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNrSchimburiDeLucruPtPrpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nr_schimburi_de_lucru_pt_prp', function (Blueprint $t) {
            $t->increments('id')->unsigned();
            $t->integer('id_prp')->unsigned()->default(0)->nullable();
            $t->integer('val');
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
        Schema::table('nr_schimburi_de_lucru_pt_prp', function (Blueprint $t) {
            $t->drop();
        });
    }
}
