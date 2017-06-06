<?php

namespace App\Models\InstrumenteDeLucru;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grad extends Model
{
	use SoftDeletes;

	protected $table = 'grade_libertate_il';
}