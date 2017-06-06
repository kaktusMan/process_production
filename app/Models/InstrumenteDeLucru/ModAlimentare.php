<?php

namespace App\Models\InstrumenteDeLucru;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModAlimentare extends Model
{
	use SoftDeletes;

	protected $table = 'moduri_alimentare_il_complexe';
}