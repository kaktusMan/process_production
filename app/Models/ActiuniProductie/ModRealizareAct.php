<?php

namespace App\Models\ActiuniProductie;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\OptionsArray;

class ModRealizareAct extends Model
{
	use OptionsArray;
	use SoftDeletes;

	protected $table = 'mod_realizare_act';
}