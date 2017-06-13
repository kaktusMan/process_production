<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaractTehnRelevPtMatPrimeAlimIlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caract_tehn_relev_pt_mat_prime_alim_il', function (Blueprint $t) {
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
        Schema::table('caract_tehn_relev_pt_mat_prime_alim_il', function (Blueprint $t) {
            $t->drop();
        });
    }
}
