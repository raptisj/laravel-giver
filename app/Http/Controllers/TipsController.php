<?php

namespace App\Http\Controllers;

use App\Tip;
use App\TotalTips;
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
            'hours' => 'required',
        ]);

        $person = new Tip;
        $person->name = $request->name;
        $person->hours = $request->hours;
        $person->save();
        session()->flash('success', 'User added succesfully');
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
    return redirect('/tips');
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
        session()->flash('deleted', 'User deleted succesfully');
        return redirect('/tips');
    }
}
