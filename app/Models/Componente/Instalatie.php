<?php

namespace App\Models\Componente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\OptionsArray;

class Instalatie extends Model
{
	use SoftDeletes;
	use OptionsArray;

	protected $table = 'lista_production_plants';

	public function fl_aferente()
    {
        return $this->hasMany('App\Models\Componente\FluxAferentPp');
    }
    
    public function op_actuali()
    {
        return $this->hasMany('App\Models\CaracteristiciOperare\OperatorActual');
    }

    public function nr_schimb()
    {
        return $this->hasMany('App\Models\CaracteristiciOperare\NrSchimb');
    }
   
}