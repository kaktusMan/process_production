<?php

namespace App\Models\InstrumenteDeLucru\Componente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnalizaFl extends Model
{
	use SoftDeletes;

	protected $table = 'lista_il_pt_analiza_optimiz_fp';


    public function tipuriFl()
    {
        return $this->belongsTo('App\Models\ActiuniProductie\Flux', 'id_fl');
    }
}