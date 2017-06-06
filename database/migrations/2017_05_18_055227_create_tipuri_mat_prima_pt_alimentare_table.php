<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipuriMatPrimaPtAlimentareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipuri_mat_prima_pt_alimentare', function (Blueprint $t) {
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
        Schema::table('tipuri_mat_prima_pt_alimentare', function (Blueprint $t) {
            $t->drop();
        });
    }
}

