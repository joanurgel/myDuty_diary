<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Diary;
class ApprovalRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    if (request()->ajax()) {
        $diaries = []; // Initialize an empty array

        if (Auth::user()->role_id == 1) {
            // Fetch all diaries for admin
            $diaries = Diary::all();
        } else {
            // Fetch diaries for supervisors
            $diaries = Diary::where('status', 0)
                ->where('supervisor_id', Auth::user()->id)
                ->get();
        }

        return $this->generateDatatables($diaries);
    }

    $approvalRequests = Diary::where('status', '=', 0)->where('supervisor_id', Auth::user()->id)->get();
    
    return view('admin.approval-requests.index', compact('approvalRequests'));
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }


//     public function approve($id)
// {
//     // Find the diary by ID
//     $diary = Diary::findOrFail($id);

//     // Update the approval status to 'approved' (1)
//     $diary->update(['approval_status' => 1]);

//     // Redirect back with a success message
//     return redirect()->back()->with('success', 'Diary has been approved.');
// }

// public function reject($id)
// {
//     // Find the diary by ID
//     $diary = Diary::findOrFail($id);

//     // Update the approval status to 'rejected' (-1)
//     $diary->update(['approval_status' => -1]);

//     // Redirect back with a success message
//     return redirect()->back()->with('success', 'Diary has been rejected.');
// }
public function generateDatatables($request)
    {
        return DataTables::of($request)
                ->addIndexColumn()
                ->addColumn('author', function($data){
                    $author = '';
                    $name = User::where('id','=',$data->author_id)->first();
                    return $author = $name->name;
                })
                ->addColumn('status', function($data){
                    $status = '';
                    if($data->status == 0){
                        $status = '<span class="badge badge-warning">Pending</span>';
                    } elseif($data->status == 1) {
                        $status = '<span class="badge badge-success">Approved</span>';
                    } else {
                        $status = '<span class="badge badge-danger">Rejected</span>';
                    }
                    return $status;
                })
                ->addColumn('title', function($data){
                    $title = '';
                    $user = User::where('id','=',$data->author_id)->first();
                    $date = $user->created_at->format('M d, Y');
                    $name = $user->name;
                    $title = 'EOD Report by ' . $name . ' on ' . $date;
                    return $title;
                })
                ->addColumn('action', function($data){
                    if($data->status == 1){
                        $hideApproveBtn = 'd-none';
                        $hideRejectBtn = '';
                    } else {
                        $hideApproveBtn = '';
                        $hideRejectBtn = 'd-none';
                    }

                    $actionButtons = '<a href="'.route("approval-requests.show",$data->id).'" data-id="'.$data->id.'" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i>
                                      </a>
                                      <button data-id="'.$data->id.'" class="btn btn-sm btn-success '.$hideApproveBtn.'btn-'.$data->id.'" onclick="approveDiary('.$data->id.')">
                                        <i class="fas fa-check"></i>
                                      </button>';
                                    //   <button data-id="'.$data->id.'" class="btn btn-sm btn-danger '.$hideRejectBtn.'" onclick="rejectDiary('.$data->id.')">
                                    //     <i class="fas fa-times"></i>
                                    //   </button>
                    return $actionButtons;
                })
                ->rawColumns(['action','role','author','status'])
                ->make(true);
    }

}
