<?php

namespace App\Models\ActiuniProductie;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\OptionsArray;

class Actiune extends Model
{		
	use SoftDeletes;
    use OptionsArray;

	protected $table = 'actiuni_productie';
}