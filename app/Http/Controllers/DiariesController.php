<?php

namespace App\Http\Controllers;
// use App\Mail\NewDiaryEmail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewDiaryPosted;

use Illuminate\Http\Request;
use App\Models\Diary;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Mail;
class DiariesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//     public function index()
// {
//     $diaries = Diary::all();
//     return view('admin.diaries.index', compact('diaries'));
// }

public function index()
    {

        // $diaries = Diary::all();
        // return view('admin.diaries.index', compact('diaries'));
        if(request()->ajax())
        {
            if(Auth::user()->role == 1){
                $diaries = Diary::all();
                return $this->generateDatatables($diaries);
            } else if(Auth::user()->role == 2){
                $supervisorId = Auth::user()->id;

                $diaries = Diary::where(function ($query) use ($supervisorId) {
                    $query->where('supervisor_id', $supervisorId)
                        ->orWhere('author_id', $supervisorId);
                })->get();
                return $this->generateDatatables($diaries);
            } else {
                $diaries = Diary::where('author_id','=',Auth::user()->id)->get();
                return $this->generateDatatables($diaries);
            }
        };

        return view('admin.diaries.index');
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
// notifs
        if($diary){
            $trainee = User::where('id','=',$diary->author_id)->first();
            $supervisor = User::where('id','=',$diary->supervisor_id)->first();
            $diary = [
                'trainee' => $trainee->name,
                'supervisor' => $supervisor->name,
                'sup_email' => $supervisor->email,
                'url' => route('approval-requests.show',$diary->id),
            ];
            
            // Mail::to($diary['sup_email'])->send(new NewDiaryEmail($diary));

            Notification::route('slack', config('notifications.slack_webhook'))->notify(new NewDiaryPosted($diary));
        }
        
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

        // $diary = Diary::findOrFail($id);
        // return view('admin.diaries.show', compact('diary'));
        // $diary = Diary::findOrFail($id);
        // return view('admin.diaries.show', compact('diary'));
        $diary = Diary::where('id','=',$id)->first();
        $user = User::where('id','=',$diary->author_id)->first();
        $date = $user->created_at->format('M d, Y');
        $name = $user->name;
        $sup = User::where('id','=',$diary->supervisor_id)->first();
        $supervisor = $sup->name;
        $title = 'EOD Report by ' . $name . ' on ' . $date;
        $diary_details = [
            'diary' => $diary,
            'name' => $name,
            'title' => $title,
            'supervisor' => $supervisor,
            'signature' => $sup->signature
        ];
        return view('admin.diaries.show')->with('diary',$diary_details);

    }

    public function print($id)
    {
        // $diary = Diary::findOrFail($id);
        // return view('admin.diaries.show', compact('diary'));
        $diary = Diary::where('id','=',$id)->first();
        $user = User::where('id','=',$diary->author_id)->first();
        $date = $user->created_at->format('M d, Y');
        $name = $user->name;
        $sup = User::where('id','=',$diary->supervisor_id)->first();
        $supervisor = $sup->name;
        $title = 'EOD Report by ' . $name . ' on ' . $date;
        $diary_details = [
            'diary' => $diary,
            'name' => $name,
            'title' => $title,
            'supervisor' => $supervisor,
            'signature' => $sup->signature
        ];
        return view('admin.diaries.print')->with('diary',$diary_details);
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
        $deleteDiary = Diary::findOrFail($id);
        
        $deleteDiary->destroy($id);
        
        if($deleteDiary){
            return response()->json(['message' => 'Diary deleted successfully']);
        } else {
            return response()->json(['error' => 'Deletion failed!']);
        }
    }



public function generateDatatables($request)
{
    return DataTables::of($request)
            ->addIndexColumn()
            ->addColumn('title', function($data){
                $date = $data->created_at->format('F j, Y');
                $author = User::where('id','=',$data->author_id)->first();
                
                // if(Auth::user()->role == 1 || Auth::user()->role == 2){
                //     return $title = 'EOD Report for '.$date.' by '.$author->name;
                // } else {
                //     return $title = 'EOD Report for '.$date;
                // }

                if ($author) { // Check if $author is a valid object
                    if(Auth::user()->role == 1 || Auth::user()->role == 2){
                        return $title = 'EOD Report for '.$date.' by '.$author->name;
                    } else {
                        return $title = 'EOD Report for '.$date;
                    }
                } else {
                    return $title = 'EOD Report for '.$date; // Default title if author is not found
                }
                
            })
            ->addColumn('status', function($data){
                $status = '';
                if($data->status == 0){
                    $status = '<span class="badge badge-danger">Pending</span>';                        
                } else {
                    $status = '<span class="badge badge-success">Approved</span>';
                }
                return $status;
            })
            ->addColumn('action', function($data){
                $actionButtons = '<a href="'.route("diaries.show",$data->id).'" data-id="'.$data->id.'" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="'.route("diaries.edit",$data->id).'" data-id="'.$data->id.'" class="btn btn-sm btn-warning editDiary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button data-id="'.$data->id.'" class="diary-delete-form btn btn-sm btn-danger" onclick="confirmDeleteDiary('.$data->id.')">
                                <i class="fas fa-trash"></i>
                                </button>';
                return $actionButtons;
            })
            ->rawColumns(['action','status','title','author'])
            ->make(true);
           
    }
}
