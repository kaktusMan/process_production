<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaracteristiciTehnPtCompRezultateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carecteristici_tehn_pt_comp_rezultate', function (Blueprint $t) {
            $t->increments('id')->unsigned();
            $t->float('lungime_finala');
            $t->float('latime_finala');
            $t->float('inaltime_finala');
            $t->float('greutate_finala');
            $t->float('volum_brut');
            $t->float('volum_net');
            $t->float('densitate');
            $t->float('grad_rugozitate');
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
        Schema::table('carecteristici_tehn_pt_comp_rezultate', function (Blueprint $t) {
            $t->drop();
        });
    }
}
