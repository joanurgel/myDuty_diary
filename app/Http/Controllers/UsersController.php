<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

        public function index(Request $request)
        {
            $users = User::all();
            return view('admin.users.index', compact('users'));
        }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
     public function store(Request $request)
     {
         // Validate the input data
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'role' => 'required|in:1,2,3',
        'password' => 'required|string|min:6',
    ]);

    // Create the new user
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
        'password' => Hash::make($request->input('password')),
    ]);

    return redirect('/users')->with('', '');
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
        $user = User::findOrFail($id);
    return view('admin.users.edit', compact('user'));
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
        // Validate the input data
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email,' . $id,
        'role' => 'required|in:1,2,3',
        'password' => 'nullable|string|min:6', // Allow the password to be nullable in case it's not updated
    ]);

    // Find the user by ID
    $user = User::find($id);

    if (!$user) {
        return redirect()->route('users.index')->with('error', 'User not found');
    }

    // Update the user data
    $user->name = $request->name;
    $user->email = $request->email;
    $user->role = $request->role;

    if ($request->filled('password')) {
        // Update the password if it's provided
        $user->password = Hash::make($request->password);
    }

    // Save the updated user data
    $user->save();

    return redirect()->route('users.index')->with('success', $user->name . ' updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteUser = User::findOrFail($id);
        $userName = $deleteUser->name;
        $deleteUser->destroy($id);
        
        if($deleteUser){
            return response()->json(['message' => $userName .' deleted successfully']);
        } else {
            return response()->json(['error' => 'Deletion failed!']);
        }
    }
    public function generateDatatables(Request $request)
{
    $users = User::query(); // Fetch users using appropriate query

    return DataTables::of($users)
        ->addIndexColumn()
        ->addColumn('role', function($user){
            $role = '';
            if ($user->role == 1) {
                $role = '<span class="badge badge-primary">Administrator</span>';
            } else if ($user->role == 2) {
                $role = '<span class="badge badge-warning">Supervisor</span>';
            } else if ($user->role == 3) {
                $role = '<span class="badge badge-secondary">Trainee</span>';
            } else {
                $role = 'Unknown Role';
            }
            return $role;
        })
        ->addColumn('action', function($user){
            $actionButtons = '<a href="'.route("users.edit", $user->id).'" class="btn btn-sm btn-warning editUser">
                                <i class="fas fa-edit"></i>
                              </a>
                              <a href="" class="btn btn-sm btn-danger" onclick="confirmDelete('.$user->id.')">
                                <i class="fas fa-trash"></i>
                              </a>';
            return $actionButtons;
        })
        ->rawColumns(['action', 'role'])
        ->make(true);
}

}
