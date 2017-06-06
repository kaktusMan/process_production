<?php

namespace App\Models\MateriiPrime;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Caracteristica extends Model
{
	use SoftDeletes;

	protected $table = 'caract_tehn_relev_pt_mat_prime_alim_il';
}