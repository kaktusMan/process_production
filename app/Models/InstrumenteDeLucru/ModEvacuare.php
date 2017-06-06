<?php

namespace App\Models\InstrumenteDeLucru;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModEvacuare extends Model
{
	use SoftDeletes;

	protected $table = 'moduri_evacuare_compon';
}