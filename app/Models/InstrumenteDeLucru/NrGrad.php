<?php

namespace App\Models\InstrumenteDeLucru;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NrGrad extends Model
{
	use SoftDeletes;

	protected $table = 'nr_grade_libertate_il';
}