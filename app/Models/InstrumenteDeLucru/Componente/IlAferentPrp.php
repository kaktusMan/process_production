<?php

namespace App\Models\InstrumenteDeLucru\Componente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IlAferentPrp extends Model
{
	use SoftDeletes;

	protected $table = 'lista_il_actuale_pt_prp';

	

    public function tipuriPrP()
    {
        return $this->belongsTo('App\Models\Componente\ProcesProductie', 'id_prp');
    }
}