<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNrGradeDeLibertateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nr_grade_libertate_il', function (Blueprint $t) {
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
        Schema::table('nr_grade_libertate_il', function (Blueprint $t) {
            $t->drop();
        });
    }
}
