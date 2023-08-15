<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diary;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class DiariesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $diaries = Diary::all();
    return view('admin.diaries.index', compact('diaries'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supervisors = User::where('role','=',2)->get();
        return view('admin.diaries.create')->with('supervisors',$supervisors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function store(Request $request)
{
    $validatedData = $request->validate([
        'plantoday' => 'required',
        'eod' => 'required',
        'roadblocks' => 'required',
        'summary' => 'required',
        'plantomorrow' => 'required',
        'supervisor' => 'required'
    ]);

    $diary = Diary::create([
        'plan_today' => $request->plantoday,
        'end_day' => $request->eod,
        'roadblocks' => $request->roadblocks,
        'summary' => $request->summary,
        'plan_tomorrow' => $request->plantomorrow,
        'author_id' => Auth::user()->id,
        'supervisor_id' => $request->supervisor,
        'status' => 0
    ]);

    $diaries = Diary::all();

    // Fetch the newly created diary with its author and supervisor
    $newDiary = Diary::with(['author', 'supervisor'])->find($diary->id);

    return view('admin.diaries.index', compact('diaries', 'newDiary'));
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
    $diary = Diary::findOrFail($id);
    $supervisors = User::where('role', '=', 2)->get();
        
    return view('admin.diaries.edit', compact('diary', 'supervisors'));
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
    $diary = Diary::findOrFail($id);

    $validatedData = $request->validate([
        'plantoday' => 'required',
        'eod' => 'required',
        'roadblocks' => 'required',
        'summary' => 'required',
        'plantomorrow' => 'required',
        'supervisor' => 'required'
    ]);

    $diary->update([
        'plan_today' => $request->input('plantoday'),
        'end_day' => $request->input('eod'),
        'roadblocks' => $request->input('roadblocks'),
        'summary' => $request->input('summary'),
        'plan_tomorrow' => $request->input('plantomorrow'),
        'supervisor_id' => $request->input('supervisor'),
        'status' => 0
    ]);

    return redirect()->route('diaries.index')->with('success', 'Diary entry updated successfully!');
}



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
    $diary = Diary::findOrFail($id);
    
    if ($diary->delete()) {
        return redirect()->route('diaries.index')->with('success', 'Diary entry deleted successfully!');
    } else {
        return redirect()->route('diaries.index')->with('error', 'Failed to delete diary entry.');
    }
}
}
