<?php

namespace App\Models\InstrumenteDeLucru;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\OptionsArray;

class CategorieIlComplexa extends Model
{
	use OptionsArray;
	use SoftDeletes;

	protected $table = 'categorii_il_complexe';
}