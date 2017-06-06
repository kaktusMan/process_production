<?php

namespace App\Models\InstrumenteDeLucru\Componente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\OptionsArray;

class IlPosibil extends Model
{
	use SoftDeletes;
	use OptionsArray;

	protected $table = 'lista_instrumente_de_lucru_posibile';

    public function tipuriIl()
    {
        return $this->belongsTo('App\Models\InstrumenteDeLucru\TipIl', 'id_tip_il');
    }

    public function opNecesari()
    {
        return $this->hasMany('App\Models\CaracteristiciOperare\OperatorNecesar');
    }
}