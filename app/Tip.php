<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tip extends Model
{
	protected $fillable = [
		'name', 'hours', 'ammount', 'total_tips', 'history_id',
	];
}
