<?php

namespace App\Models\MateriiPrime;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tip extends Model
{
	use SoftDeletes;

	protected $table = 'tipuri_mat_prima_pt_alimentare';
}