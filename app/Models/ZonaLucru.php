<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ZonaLucru extends Model
{
	use SoftDeletes;

	protected $table = 'zone_de_lucru';
}