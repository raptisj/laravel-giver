<?php

namespace App\Http\Controllers;

use App\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
	public function index()
	{
		$history = new History;
		$po = $history->round()->pluck('tip_rounds.days_total');
		dd($po);
		return view('tips.all-tips', compact('history'));
	}
}
