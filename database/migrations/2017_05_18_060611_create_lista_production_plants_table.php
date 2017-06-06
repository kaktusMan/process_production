<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListaProductionPlantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista_production_plants', function (Blueprint $t) {
            $t->increments('id')->unsigned();
            $t->string('nume');
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
        Schema::table('lista_production_plants', function (Blueprint $t) {
            $t->drop();
        });
    }
}
