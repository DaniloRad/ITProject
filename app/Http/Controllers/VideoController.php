<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\Category;
class VideoController extends Controller
{

    public function __construct() {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $videos = Video::where('active', true)->paginate(5);
        return view('admin.videos.index', compact('videos', 'categories'));
    }

    public function addVideo(Request $request) {

        $request->validate([
            'name' => 'required|string|max:100',
            'video'=> 'required|mimes:mp4',
            'image' => 'required|mimes:jpg,jpeg,png',
            'episode' => 'required|numeric',
            'season' => 'required|numeric',
            'description' => 'required|string|max:1000',
            'category_id'=> 'required',
            'broadcast_date'=> 'required|date'
        ]);
        
        $video = new Video;
        $video->name = $request->name;

        $video->episode = $request->episode;
        $video->season = $request->season;
        $video->description = $request->description;
        $video->category_id = $request->category_id;
        $video->broadcast_date = $request->broadcast_date;
        
        if (request()->hasFile('image')) {
            $destinationPath = '/images/video/';
            $imageName = request()->file('image')->getClientOriginalName();
            $filenameCover = time() . str_replace(' ', '_', $imageName);;
            request()->file('image')->move(public_path() . $destinationPath, $filenameCover);
            $video->image = $destinationPath . $filenameCover;
        }

        if (request()->hasFile('video')) {
            $destinationPath = '/images/video/';
            $imageName = request()->file('video')->getClientOriginalName();
            $filenameCover = time() . str_replace(' ', '_', $imageName);;
            request()->file('video')->move(public_path() . $destinationPath, $filenameCover);
            $video->videoURL = $destinationPath . $filenameCover;
        }



        $video->save();
        return redirect()->back();
    }

    public function deleteVideo($id) {

        if($id == '' || $id == null) {
            abort(500, 'Morate da predate ID emisije');
        } else {
            $video = Video::findOrFail($id);
            $video->active = false;
            $video->save();
            return redirect()->back();
        }
    }

    public function editVideo($id) {

        $categories = Category::all();
        $video = Video::findOrFail($id);
        return view('admin.videos.edit', compact('video', 'categories'));
    }

    public function updateVideo(Request $request) {

        $request->validate([ 
            'name' => 'required|string|max:100',
            'video'=> 'mimes:mp4',
            'image' => 'mimes:jpg,jpeg,png',
            'episode' => 'required|numeric',
            'season' => 'required|numeric',
            'description' => 'required|string|max:1000',
            'category_id'=> 'required',
            'broadcast_date'=> 'required|date'
        ]);

        $video = Video::findOrFail($request->id);
        $video->name = $request->name;

        $video->episode = $request->episode;
        $video->season = $request->season;
        $video->description = $request->description;
        $video->category_id = $request->category_id;
        $video->broadcast_date = $request->broadcast_date;
        
        if (request()->hasFile('image')) {
            $destinationPath = '/images/video/';
            $imageName = request()->file('image')->getClientOriginalName();
            $filenameCover = time() . str_replace(' ', '_', $imageName);;
            request()->file('image')->move(public_path() . $destinationPath, $filenameCover);
            $video->image = $destinationPath . $filenameCover;
        }

        if (request()->hasFile('video')) {
            $destinationPath = '/images/video/';
            $imageName = request()->file('video')->getClientOriginalName();
            $filenameCover = time() . str_replace(' ', '_', $imageName);;
            request()->file('video')->move(public_path() . $destinationPath, $filenameCover);
            $video->videoURL = $destinationPath . $filenameCover;
        }



        $video->save();
        return redirect('/my-videos');
    }
}
