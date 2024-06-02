<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Kreait\Firebase\Contract\Database;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Support\Str;
use DOMDocument;
use Carbon\Carbon;
use Session;

class NewsController extends Controller
{
    /**
     * Firebase.
     */
    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = 'news';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reference = $this->database->getReference($this->tablename)->getValue();
        return view ('news.listNews.index', compact('reference'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('news.createNews.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $summernote = $request->summernote;

        $dom = new DOMDocument();
        $dom->loadHTML($summernote,9);

        $image = $dom->getElementsByTagName('img');

        foreach ($image as $key => $img) {
            $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $img->getAttribute('src')));
            $targetDirectory = public_path() . '/upload/';
            $image_name = "/upload/" .time(). $key.'.png';

            $targetFile = $targetDirectory . $image_name;

            // Pastikan direktori ada, jika tidak, buat direktori baru
            if (!file_exists($targetDirectory)) {
                mkdir($targetDirectory, 0777, true);
            }

            file_put_contents(public_path().$image_name, $data);

            $img->removeAttribute('src');
            $img->setAttribute('src',$image_name);
        }
        $summernote = $dom->saveHTML();

        $thumbnail_active = $request->checkbox ?? 'N';
        $carousel_active = $request->carousel ?? 'N';
        
        $request->validate([
            'thumbnail' => 'required',
          ]);
          $image = $request->file('thumbnail'); //image file from frontend
  
          $student   = app('firebase.firestore')->database()->collection('Images')->document(Str::random(10));
          $firebase_storage_path = 'Images/';
          $name     = $student->id();
          $localfolder = public_path('firebase-temp-uploads') .'/';
          $extension = $image->getClientOriginalExtension();
          $file      = $name. '.' . $extension;
          if ($image->move($localfolder, $file)) {
            $uploadedfile = fopen($localfolder.$file, 'r');
            app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $file]);
            //will remove from local laravel folder
            unlink($localfolder . $file);
            Session::flash('message', 'Succesfully Uploaded');
          }

        $postData = [
            'date_created' => Carbon::now(),
            'title' => $request->title,
            'thumbnail' => $file,
            'description' => $summernote,
            'is_active' => $thumbnail_active,
            'is_carousel' =>  $carousel_active,
        ];
        $postRef = $this->database->getReference($this->tablename)->push($postData);

        if($postRef) {
            return redirect('news')->with('Complete insert new event');
        } else {
            return redirect('news')->with('Failed insert new event');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($key)
    {
        $reference = $this->database->getReference($this->tablename)->getValue();
        $showPost = $reference[$key];;

        $expiresAt = new \DateTime('tomorrow');
        $imageReference = app('firebase.storage')->getBucket()->object("Images/".$showPost['thumbnail']);

        if ($imageReference->exists()) {
          $image = $imageReference->signedUrl($expiresAt);
        } else {
          $image = null;
        }

        return view('news.showNews.index', compact('showPost','image'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($key)
    {
        $reference = $this->database->getReference($this->tablename)->getValue();
        $getData = $reference[$key];;
        $imageReference = app('firebase.storage')->getBucket()->object("Images/".$getData['thumbnail']);

        $showData = $this->database->getReference($this->tablename)->getChild($key)->getValue();
        if($showData) {
            return view('news.editNews.index', compact('showData', 'key', 'imageReference'));
        } else {
            return view('news')->with('status', 'Contact ID Not Found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $key)
    {
        $reference = $this->database->getReference($this->tablename)->getValue();
        $getData = $reference[$key];;
        $getDataGambar = $getData['thumbnail'];
        $subGambar = substr($getDataGambar,0,10);

        $summernote = $request->summernote;

        $dom = new DOMDocument();
        $dom->loadHTML($summernote,9);

        $image = $dom->getElementsByTagName('img');

        foreach ($image as $id => $img) {

            if(strpos($img->getAttribute('src'),'data:image') === 0) {
                $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $img->getAttribute('src')));
                $image_name = "/upload/" .time(). $key.'.png';
                file_put_contents(public_path().$image_name, $data);

                $img->removeAttribute('src');
                $img->setAttribute('src',$image_name);
            } 
        }
        $summernote = $dom->saveHTML();

        $thumbnail_active = $request->checkbox ?? 'N';
        $carousel_active = $request->carousel ?? 'N';

        $image = $request->file('thumbnail'); //image file from frontend
        if($image != null) {
            $student   = app('firebase.firestore')->database()->collection('Images')->document($subGambar);
            $firebase_storage_path = 'Images/';
            $name     = $student->id();
            $localfolder = public_path('firebase-temp-uploads') .'/';
            $extension = $image->getClientOriginalExtension();
            $file      = $name. '.' . $extension;
            if ($image->move($localfolder, $file)) {
                $uploadedfile = fopen($localfolder.$file, 'r');
                app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $file]);
                //will remove from local laravel folder
                unlink($localfolder . $file);
                Session::flash('message', 'Succesfully Uploaded');
            }
        } else { 
            $file = $getData['thumbnail'];
        }

        $editPost = [
            'date_created' => $getData['date_created'],
            'title' => $request->title,
            'thumbnail' => $file,
            'description' => $summernote,
            'is_active' => $thumbnail_active,
            'is_carousel' =>  $carousel_active,
        ];

        $updatePost = $this->database->getReference($this->tablename.'/'.$key)->set($editPost);

        if($updatePost) {
            return redirect('news')->with('Complete update new event');
        } else {
            return redirect('news')->with('Failed update new event');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($key)
    {
        $reference = $this->database->getReference($this->tablename)->getValue();
        $deleteImg = $reference[$key];
        $imageDeleted = app('firebase.storage')->getBucket()->object("Images/".$deleteImg['thumbnail'])->delete();

        $deleteContent = $this->database->getReference($this->tablename.'/'.$key)->remove();
        return redirect()->route('news');
    }
}
