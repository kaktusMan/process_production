<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModRealizareActTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mod_realizare_act', function (Blueprint $t) {
            $t->increments('id')->unsigned();
            $t->string('nume');
            $t->integer('id_actiune')->unsigned()->default(0)->nullable();
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
        Schema::table('mod_realizare_act', function (Blueprint $t) {
            $t->drop();
        });
    }
}
