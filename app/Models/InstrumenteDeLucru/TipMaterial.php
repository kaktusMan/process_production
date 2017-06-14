<?php

namespace App\Models\InstrumenteDeLucru;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\OptionsArray;

class TipMaterial extends Model
{
	use OptionsArray;
	use SoftDeletes;

	protected $table = 'tipuri_materiale';

}
