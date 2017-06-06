<?php

namespace App\Models\CaracteristiciOperare;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\OptionsArray;

class NrOre extends Model
{
	use SoftDeletes;
	use OptionsArray;

	protected $table = 'nr_ore_nete_pe_schimb_de_lucru';

	public function nrSchimb()
    {
        return $this->belongsTo('App\Models\CaracteristiciOperare\NrSchimb', 'id_nr_schimb');
    }
}