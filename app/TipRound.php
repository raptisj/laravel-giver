<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipRound extends Model
{
    protected $fillable = [
		'days_total', 'historie_id'
	];

	public function history() 
	{
		return $this->belongsTo(History::class);
	}
}
