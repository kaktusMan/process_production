<?php

namespace App\Models\ActiuniProductie;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\OptionsArray;

class Flux extends Model
{
	use OptionsArray;
	use SoftDeletes;

	protected $table = 'fluxuri_de_lucru';

	public function fl_prp()
    {
        return $this->hasMany('App\Models\Componente\ProcesProductie');
    }

    public function fl_il_optimizate()
    {
        return $this->hasMany('App\Models\InstrumenteDeLucru\Componente\AnalizaFl');
    }
}