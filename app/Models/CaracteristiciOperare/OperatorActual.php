<?php

namespace App\Models\CaracteristiciOperare;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\OptionsArray;

class OperatorActual extends Model
{
	use SoftDeletes;
    use OptionsArray;

	protected $table = 'lista_operatori_actuali';



	public function PP()
    {
        return $this->belongsTo('App\Models\Componente\Instalatie', 'id_pp');
    }

    public function tipOp()
    {
        return $this->belongsTo('App\Models\CaracteristiciOperare\TipOperator', 'id_tip_op');
    }

    public function gradIncarcare()
    {
        return $this->hasMany('App\Models\CaracteristiciOperare\GradIncarcareOrara');
    }
}


