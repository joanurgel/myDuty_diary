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
            // $users = User::all();
            // return view('admin.users.index', compact('users'));
            if(request()->ajax())
        {
            $users = User::where('id','!=',Auth::user()->id)->get();
            return $this->generateDatatables($users);
        };
        return view('admin.users.index');
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
        'isPicComplete' => 0,
        'isSignatureComplete' => 0
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
        $profile = User::find($id);

        return view('admin.profile.index')->with('profile', $profile);
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
    $user->isComplete = 1;

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

     public function updateProfilePic(Request $request, $id)
     {
         if(request()->ajax()){
             try {            
                 $request->validate([
                     'profilePic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image file
                 ]);
         
                 if ($request->hasFile('profilePic')) {
                     $imageFile = $request->file('profilePic');
                     $originalName = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                     // originalName-time.extension
                     $filename = $originalName . "-" . time() . '.' . $imageFile->getClientOriginalExtension();
                     
                     $path = 'uploads/profiles/'.$filename;
                     $user = User::findOrFail($id);
                     // dd($path);
                     $user->update([
                         'img' => $path,
                         'isPicComplete' => 1
                     ]);
 
                     if($user){
                         $imageFile->storeAs('public/uploads/profiles/', $filename);
 
                         $successMessage = $user->name .'\'s profile picture successfully uploaded!';
 
                         return response()->json(['successMessage' => $successMessage]);
                     }
                 }
                 // return redirect()->route('success')->with('success', 'Data saved successfully!');
             } catch (ValidationException $e) {
                 return redirect()->back()->withErrors($e->errors())->withInput();
             }
         }
     } 


     public function updateSignature(Request $request, $id)
    {
        if(request()->ajax()){
            try {            
                $request->validate([
                    'signature' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image file
                ]);
        
                if ($request->hasFile('signature')) {
                    $imageFile = $request->file('signature');
                    $originalName = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                    // originalName-time.extension
                    $filename = $originalName . "-" . time() . '.' . $imageFile->getClientOriginalExtension();
                    
                    $path = 'uploads/signatures/'.$filename;
                    $user = User::findOrFail($id);
                    // dd($path);
                    $user->update([
                        'signature' => $path,
                        'isSignatureComplete' => 1
                    ]);

                    if($user){
                        $imageFile->storeAs('public/uploads/signatures/', $filename);

                        $successMessage = $user->name.'\'s signature successfully uploaded!';

                        return response()->json(['successMessage' => $successMessage]);
                    }
                }
                // return redirect()->route('success')->with('success', 'Data saved successfully!');
            } catch (ValidationException $e) {
                return redirect()->back()->withErrors($e->errors())->withInput();
            }
        }
    }

    public function updateProfileName(Request $request, $id)
    {
        if(request()->ajax()){
            try {            
                $request->validate([
                    'name' => 'required|string|max:255', // Validate the image file
                ]);
        
                $user = User::findOrFail($id);
            
                $user->update([
                    'name' => $request->name,
                ]);

                if($user){
                    $successMessage = 'Profile name is now '.$user->name;

                    return response()->json(['successMessage' => $successMessage]);
                }

                // return redirect()->route('success')->with('success', 'Data saved successfully!');
            } catch (ValidationException $e) {
                return redirect()->back()->withErrors($e->errors())->withInput();
            }
        }
    }

    public function updatePassword(Request $request, $id)
    {
            try {            
                $request->validate([
                    'password' => 'required|string|max:255', 
                ]);
                
                $user = User::findOrFail($id);
            
                $user->update([
                    'password' => Hash::make($request->password),
                    'isPassChanged' => 1
                ]);
                
                if($user){
                    $successMessage = 'Your password is now updated '.$user->name.'!';

                    return response()->json(['successMessage' => $successMessage]);
                }

                // return redirect()->route('success')->with('success', 'Data saved successfully!');
            } catch (ValidationException $e) {
                return redirect()->back()->withErrors($e->errors())->withInput();
            }
        // }
    }

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

    public function generateDatatables($request)
    {
        return DataTables::of($request)
                ->addIndexColumn()
                ->addColumn('role', function($data){
                    $role = '';
                    if($data->role == 1){
                        $role = '<span class="badge badge-primary">Administrator</span>';
                    } else if($data->role == 2){
                        $role = '<span class="badge badge-success">Supervisor</span>';
                    } else {
                        $role = '<span class="badge badge-secondary">Trainee</span>';
                    }
                    return $role;
                })
                ->addColumn('action', function($data){
                    $actionButtons = '<a href="'.route("users.edit",$data->id).'" data-id="'.$data->id.'" class="btn btn-sm btn-warning editUser">
                                        <i class="fas fa-edit"></i>
                                      </a>
                                      <button data-id="'.$data->id.'" class="btn btn-sm btn-danger" onclick="confirmDelete('.$data->id.')">
                                        <i class="fas fa-trash"></i>
                                      </button>';
                    return $actionButtons;
                })
                ->rawColumns(['action','role'])
                ->make(true);
    }
}
