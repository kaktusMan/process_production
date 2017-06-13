<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActiuniProductieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actiuni_productie', function (Blueprint $t) {
            $t->increments('id')->unsigned();
            $t->integer('tipuri_id')->unsigned()->default(0)->nullable()->comment('tipuri material pt realiz act');
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
        Schema::table('actiuni_productie', function (Blueprint $t) {
            $t->drop();
        });
    }
}