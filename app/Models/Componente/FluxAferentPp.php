<?php

namespace App\Models\Componente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FluxAferentPp extends Model
{
	use SoftDeletes;

	protected $table = 'lista_fluxuri_pp';

	

    public function tipuriPp()
    {
        return $this->belongsTo('App\Models\Componente\Instalatie', 'id_pp');
    }
}