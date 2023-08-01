<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

    return redirect('/users')->with('success', 'User created successfully');
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

    return redirect()->route('users.index')->with('success', 'User updated successfully');

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
}


// <?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\User;
// use Illuminate\Support\Facades\Hash;

// class UsersController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function index()
//     {
//         $users = User::all();
//         // dd($users);
//         return view('admin.users.index')->with('users',$users);
//     }

//     /**
//      * Show the form for creating a new resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function create()
//     {
//         return view('admin.users.create');
//     }

//     /**
//      * Store a newly created resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\Response
//      */
//     public function store(Request $request)
//     {
//         try {
//             $validatedData = $request->validate([
//                 'name' => 'required|string|max:255',
//                 'role' => 'required|numeric',
//                 'email' => 'required|email',
//                 'temp-password' => 'required|min:8',
//             ]);
    
//             $user = User::create([
//                 'name' => $request->name,
//                 'role_id' => $request->role,
//                 'email' => $request->email,
//                 'password' => Hash::make($request->input('temp-password')),
//             ]);
    
//             $users = User::all();
            
//             return view('admin.users.index')->with('users',$users);
//             // return redirect()->route('success')->with('success', 'Data saved successfully!');
//         } catch (ValidationException $e) {
//             return redirect()->back()->withErrors($e->errors())->withInput();
//         }
//     }

//     /**
//      * Display the specified resource.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function show($id)
//     {
//         //
//     }

//     /**
//      * Show the form for editing the specified resource.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function edit($id)
//     {
//         $user = User::findOrFail($id);
        
//         return view('admin.users.edit')->with('user',$user);
//     }

//     /**
//      * Update the specified resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function update(Request $request, $id)
//     {
//         try {
//             $validatedData = $request->validate([
//                 'name' => 'required|string|max:255',
//                 'role' => 'required|numeric',
//                 'email' => 'required|email',
//             ]);
    
//             $user = User::findOrFail($id);
            
//             $user->update([
//                 'name' => $request->name,
//                 'role_id' => $request->role,
//                 'email' => $request->email,
//             ]);
    
//             $users = User::all();
            
//             return view('admin.users.index')->with([
//                 'users'=>$users,
//                 'user_name'=>$user->name
//             ]);
//             // return redirect()->route('success')->with('success', 'Data saved successfully!');
//         } catch (ValidationException $e) {
//             return redirect()->back()->withErrors($e->errors())->withInput();
//         }
//     }

//     /**
//      * Remove the specified resource from storage.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function destroy($id)
//     {
//         $deleteUser = User::findOrFail($id);
//         // dd($deleteUser,$deleteUser->name);
//         $userName = $deleteUser->name;
//         $deleteUser->destroy($id);
        
//         if($deleteUser){
//             return response()->json(['message' => $userName .' deleted successfully']);
//         } else {
//             return response()->json(['error' => 'Deletion failed!']);
//         }
//     }
// }