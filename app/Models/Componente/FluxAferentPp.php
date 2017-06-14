<?php

namespace App\Models\Componente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\OptionsArray;


class FluxAferentPp extends Model
{
	use SoftDeletes;
	use OptionsArray;

	protected $table = 'lista_fluxuri_pp';

    public function tipuriPp()
    {
        return $this->belongsTo('App\Models\Componente\Instalatie', 'id_pp');
    }

    public function fl_prp()
    {
        return $this->hasMany('App\Models\Componente\ProcesProductie');
    }
}