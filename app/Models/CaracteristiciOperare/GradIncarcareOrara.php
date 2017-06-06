<?php

namespace App\Models\CaracteristiciOperare;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\OptionsArray;

class GradIncarcareOrara extends Model
{
	use SoftDeletes;
	use OptionsArray;

	protected $table = 'grad_incarcare_operatori';

    public function operatori()
    {
        return $this->belongsTo('App\Models\CaracteristiciOperare\OperatorActual', 'id_op');
    }
}