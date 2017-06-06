<?php

namespace App\Models\ActiuniProductie;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\OptionsArray;

class NivelGrupare extends Model
{
	use SoftDeletes;
	use OptionsArray;
	
	protected $table = 'nivele_grupare_act';

	public function tipuri_il()
    {
        return $this->hasMany('App\Models\InstrumenteDeLucru\TipIl');
    }
}