<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradIncarcareOperatoriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grad_incarcare_operatori', function (Blueprint $t) {
            $t->increments('id')->unsigned();
            $t->integer('id_op')->unsigned()->default(0)->nullable();
            $t->float('grad_de_incarcare');
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
        Schema::table('grad_incarcare_operatori', function (Blueprint $t) {
            $t->drop();
        });
    }
}
