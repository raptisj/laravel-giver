<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
	protected $guarded = [];

	public function eachTip() 
	{
		return $this->hasMany(Tip::class);
	}
} 
