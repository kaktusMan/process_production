<?php

namespace App\Models\CaracteristiciOperare;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\OptionsArray;

class NrSchimb extends Model
{
	use SoftDeletes;
	use OptionsArray;

	protected $table = 'nr_schimburi_de_lucru_pt_prp';

	public function Prp()
    {
        return $this->belongsTo('App\Models\Componente\Instalatie', 'id_prp');
    }

    public function orePeSchimb()
    {
        return $this->hasMany('App\Models\CaracteristiciOperare\NrOre');
    }
}