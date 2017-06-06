<?php

namespace App\Models\InstrumenteDeLucru\Componente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModFolosinta extends Model
{
	use SoftDeletes;

	protected $table = 'moduri_folosinta_il';
}