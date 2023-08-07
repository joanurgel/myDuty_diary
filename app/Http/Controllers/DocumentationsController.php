<?php

namespace App\Http\Controllers;
use App\Models\Documentation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use App\Http\Controllers\DocumentationsController;

class DocumentationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $docs = Documentation::all();
        return view('admin.documentations.index', compact('docs'));
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
         $request->validate([
             'doc_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example image validation rules
         ]);
     
         // Default value for author_id (change this according to your needs)
         $defaultAuthorId = 0;
     
         // Set author_id to the default value if Auth::check() is false
         $userId = Auth::check() ? Auth::id() : $defaultAuthorId;
     
         if ($request->hasFile('doc_img')) {
             $imageFile = $request->file('doc_img');
             $originalName = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
             $fileName = $originalName . "." . time() . '.' . $imageFile->getClientOriginalExtension();
             $path = $imageFile->storeAs('public/upload/images', $fileName);
     
             // Save the image details to the database
             Documentation::create([
                 'image' => $fileName,
                 'caption' => $request->caption,
                 'author_id' => $userId,
             ]);
             // Fetch all documents again after storing the new image
             $docs = Documentation::all();
             return view('admin.documentations.index', compact('docs'))->with('uploadSuccess','The image '.$fileName.' successfully uploaded!');
         }
     
         // If there's an issue with image upload, return the view without $docs variable
         return view('admin.documentations.index');
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
}
