<?php

namespace App\Models\InstrumenteDeLucru;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipConsumabile extends Model
{
	use SoftDeletes;

	protected $table = 'tipuri_consumabile_il';
}