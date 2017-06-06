<?php

namespace App\Models\CaracteristiciOperare;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\OptionsArray;

class OperatorNecesar extends Model
{
	use SoftDeletes;
	use OptionsArray;

	protected $table = 'nr_oparatori_simultani_neces_pt_funct_il';
	 
    public function Il()
    {
        return $this->belongsTo('App\Models\InstrumenteDeLucru\Componente\IlPosibil', 'id_il');
    }
}