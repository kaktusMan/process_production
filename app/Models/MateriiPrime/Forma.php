<?php

namespace App\Models\MateriiPrime;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forma extends Model
{
	use SoftDeletes;

	protected $table = 'forme_mat_prima_pt_alimentare';
}