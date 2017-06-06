<?php

namespace App\Models\InstrumenteDeLucru;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\OptionsArray;

class CaracteristicaTehnica extends Model
{
	use OptionsArray;
	use SoftDeletes;

	protected $table = 'carecteristici_tehn_pt_il';
}