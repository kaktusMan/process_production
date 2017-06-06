<?php

namespace App\Models\ActiuniProductie;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\OptionsArray;

class ModalitateRealizareAct extends Model
{
	use OptionsArray;
	use SoftDeletes;

	protected $table = 'modalitati_realizare_act';

    public function actiuniPr()
    {
        return $this->belongsTo('App\Models\ActiuniProductie\Actiune', 'id_actiune');
    }

    public function tipuri_il()
    {
        return $this->hasMany('App\Models\InstrumenteDeLucru\TipIl');
    }
}
