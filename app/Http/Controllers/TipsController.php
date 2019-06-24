<?php

namespace App\Http\Controllers;

use App\Tip;
use App\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class TipsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $person = Tip::all();
        $summedHours = $person->pluck('hours')->reduce(function ($carry, $item) {
            return $carry + $item;
        });
        // $this->endDay($sumedHours);
         // $test = View::share('sumedHours', $sumedHours);
        View::share('summedHours', $summedHours);
        View::share('person', $person);
    }


    public function index()
    {
        // $tips = Tip::all();

        $history = new History;
        $history->save();
        return view('tips.tips-grid', compact('person', 'summedHours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'hours' => 'required|numeric',
        ]);

        $person = new Tip;
        $person->name = $request->name;
        $person->hours = $request->hours;
        // $person->history_id = History::eachTips()->id;
        $person->save();
        
        // $history = new History;
        // $person->history_id = 'htht';
        session()->flash('success', 'User added successfully');
        return redirect('/tips');
    }

    public function addTotal(Request $request) 
    {
        $request->validate([
            'total_tips' => 'required|numeric',
        ]);

        session(['key' => $request->total_tips]);

        return redirect('/tips');
    }


    public function endDay()
    {
        $person = Tip::all();
        $summedHours = $person->pluck('hours')->reduce(function ($carry, $item) {
            return $carry + $item;
        });

        $baseTip = session('key') / $summedHours; 

        $person->map(function ($item, $key) use ($baseTip) {
            return Tip::whereId($item->id)->update(['ammount' => $item->hours * $baseTip]);
        });

        // $history = new History;
        // $history->save();
        // $op = $history->id;

        // $te = $person->map(function ($item, $key) use ($op) {
        //      return $item->history_id = 'hello';
        // });
        // dd($te);
        // dd($history->id);

        session()->forget('key');
        return redirect('/all-tips');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $person = Tip::findOrFail($id)->delete();
        session()->flash('deleted', 'User deleted successfully');
        return redirect('/tips');
    }
}
