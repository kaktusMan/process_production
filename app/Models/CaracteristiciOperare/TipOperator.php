<?php

namespace App\Models\CaracteristiciOperare;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\OptionsArray;

class TipOperator extends Model
{
	use SoftDeletes;
	use OptionsArray;

	protected $table = 'tipuri_operatori_pt_functionare_il';

	public function op_actuali()
    {
        return $this->hasMany('App\Models\CaracteristiciOperare\OperatorActual');
    }
}