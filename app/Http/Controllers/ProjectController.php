<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Kreait\Firebase\Contract\Database;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Firebase.
     */
    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = 'project';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reference = $this->database->getReference($this->tablename)->getValue();
        return view ('project.listProject.index', compact('reference'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('project.createProject.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dateRange = $request->deadline;
        $startDate = substr($dateRange,0,10);
        $endDate = substr($dateRange,-10);

        $postData = [
            'title' => $request->title,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'description' => $request->description,
        ];

        $postRef = $this->database->getReference($this->tablename)->push($postData);

        if($postRef) {
            return redirect('project')->with('Complete insert new event');
        } else {
            return redirect('project')->with('Failed insert new event');
        }
    }   

    /**
     * Display the specified resource.
     */
    public function show($key)
    {
        $reference = $this->database->getReference($this->tablename)->getValue();
        $showProject = $reference[$key];;

        return view('project.showProject.index', compact('showProject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($key)
    {
        $showProject = $this->database->getReference($this->tablename)->getChild($key)->getValue();
        if($showProject) {
            return view('project.editProject.index', compact('showProject', 'key'));
        } else {
            return view('project')->with('status', 'Contact ID Not Found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $key)
    {
        $dateRange = $request->deadline;
        $startDate = substr($dateRange,0,10);
        $endDate = substr($dateRange,-10);

        $updateData = [
            'title' => $request->title,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'description' => $request->description,
        ];

        $updateRef = $this->database->getReference($this->tablename.'/'.$key)->set($updateData);

        if($updateRef) {
            return redirect('project')->with('Complete insert new event');
        } else {
            return redirect('project')->with('Failed insert new event');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($key)
    {
        $deleteContent = $this->database->getReference($this->tablename.'/'.$key)->remove();
        return redirect()->route('project');
    }
}
