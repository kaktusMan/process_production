<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaractTehnRelevPtIlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carecteristici_tehn_pt_il', function (Blueprint $t) {
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
        Schema::table('carecteristici_tehn_pt_il', function (Blueprint $t) {
            $t->drop();
        });
    }
}
