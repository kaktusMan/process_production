<?php

namespace App\Models\Componente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\OptionsArray;

class ProcesProductie extends Model
{
	use SoftDeletes;
	use OptionsArray;

	protected $table = 'lista_procese_productie_pt_fl';

	public function tipuriFl()
    {
        return $this->belongsTo('App\Models\ActiuniProductie\Flux', 'id_fl');
    }

    public function ilAferent()
    {
        return $this->hasMany('App\Models\InstrumenteDeLucru\Componente\IlAferentPrp');
    }
}

