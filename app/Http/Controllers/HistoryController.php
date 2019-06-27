<?php

namespace App\Http\Controllers;

use App\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
	public function index()
	{
		$history = History::all();
		// $historyTips = $history->tipsRound;
		return view('tips.all-tips', compact('history'));
	}
}
