<?php

namespace App\Models\ActiuniProductie;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\OptionsArray;

class TipOperatie extends Model
{
	use OptionsArray;
	use SoftDeletes;

	protected $table = 'tipuri_operatii';
}