<?php

namespace App\Models\InstrumenteDeLucru;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\OptionsArray;

class TipIl extends Model
{
	use SoftDeletes;
	use OptionsArray;


	protected $table = 'tipuri_il';

	public function il_posibile()
    {
        return $this->hasMany('App\Models\InstrumenteDeLucru\Componente\IlPosibil');
    }
    
    public function nivele_grupare()
    {
        return $this->belongsTo('App\Models\ActiuniProductie\NivelGrupare', 'id_niv_grupare');
    }

    public function modalitati_realiz()
    {
        return $this->belongsTo('App\Models\ActiuniProductie\ModalitateRealizareAct', 'id_modalit_realiz');
    }
}