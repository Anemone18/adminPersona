<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Kreait\Firebase\Contract\Database;

class CalenderController extends Controller
{
    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename1 = 'event';
        $this->tablename2 = 'project';
    }

    public function index () {
        return view ('calender.index');
    }

    public function listEvent (Request $request) {
        $start = date('Y-m-d', strtotime($request->start));
        $end = date('Y-m-d', strtotime($request->end));

        $referenceEvent = $this->database->getReference($this->tablename1)->getValue();
        $referenceProject = $this->database->getReference($this->tablename2)->getValue();
        
        $id = 1;

        foreach ($referenceEvent as $referenceEvents) {
            $event[] = [
                'id' => $id++,
                'title' => $referenceEvents['title'],
                'start' => date('Y-m-d', strtotime($referenceEvents['startDate'])),
                'end' => date('Y-m-d', strtotime($referenceEvents['endDate']. ' +1 day')),
                'color' => '#3257a8'
            ];
        } 

        foreach ($referenceProject as $referenceProjects) {
            $event[] = [
                'id' => $id++,
                'title' => $referenceProjects['title'],
                'start' => date('Y-m-d', strtotime($referenceProjects['startDate'])),
                'end' => date('Y-m-d', strtotime($referenceProjects['endDate']. ' +1 day')),
                'color' => '#32a869'
            ];
        } 
        return response()->json($event);
    }
}
