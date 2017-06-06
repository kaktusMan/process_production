<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuriAlimentareIlComplexeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moduri_alimentare_il_complexe', function (Blueprint $t) {
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
        Schema::table('moduri_alimentare_il_complexe', function (Blueprint $t) {
            $t->drop();
        });
    }
}