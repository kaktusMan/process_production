<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNrOperatoriSimultaniNecesPtFuncIlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nr_oparatori_simultani_neces_pt_funct_il', function (Blueprint $t) {
            $t->increments('id')->unsigned();
            $t->integer('id_op')->unsigned()->default(0)->nullable();
            $t->integer('id_il')->unsigned()->default(0)->nullable();
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
        Schema::table('nr_oparatori_simultani_neces_pt_funct_il', function (Blueprint $t) {
            $t->drop();
        });
    }
}