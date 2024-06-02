<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Support\Str;
use Session;

class ApprovalController extends Controller
{
    /**
     * Firebase.
     */
    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = 'approval';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reference = $this->database->getReference($this->tablename)->getValue();
        return view ('approval.listApproval.index', compact('reference'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('approval.createApproval.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $document = $request->file('document'); //image file from frontend
  
          $student   = app('firebase.firestore')->database()->collection('Document')->document(Str::random(10));
          $firebase_storage_path = 'Document/';
          $name     = $student->id();
          $localfolder = public_path('firebase-temp-uploads') .'/';
          $extension = $document->getClientOriginalExtension();
          $file      = $name. '.' . $extension;
          if ($document->move($localfolder, $file)) {
            $uploadedfile = fopen($localfolder.$file, 'r');
            app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $file]);
            //will remove from local laravel folder
            unlink($localfolder . $file);
            Session::flash('message', 'Succesfully Uploaded');
        }

        $status = 'P';

        $postData = [
            'title' => $request->title,
            'supervisor' => $request->supervisor,
            'description' => $request->description,
            'document' => $file,
            'status' => $status,
        ];

        $postRef = $this->database->getReference($this->tablename)->push($postData);

        if($postRef) {
            return redirect('approval')->with('Complete insert new event');
        } else {
            return redirect('approval')->with('Failed insert new event');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reference = $this->database->getReference($this->tablename)->getValue();
        $showApproval = $reference[$key];

        return view('approval.showApproval.index', compact('showApproval'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
