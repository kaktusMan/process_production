<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Componenta extends Model
{
	use SoftDeletes;

	protected $table = 'carecteristici_tehn_pt_comp_rezultate';
}