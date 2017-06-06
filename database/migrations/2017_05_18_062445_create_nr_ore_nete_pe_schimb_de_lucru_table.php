<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNrOreNetePeSchimbDeLucruTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nr_ore_nete_pe_schimb_de_lucru', function (Blueprint $t) {
            $t->increments('id')->unsigned();
            $t->integer('id_nr_schimb')->unsigned()->default(0)->nullable();
            $t->float('ore_nete_op');
            $t->float('ore_nete_il');
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
        Schema::table('nr_ore_nete_pe_schimb_de_lucru', function (Blueprint $t) {
            $t->drop();
        });
    }
}

