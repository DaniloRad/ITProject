<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Video;
use App\Recipe;
use App\Comment;
use App\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;

class WebsiteController extends Controller
{
    
    public function indexView() {
        $videos = Video::where('active', true)->orderBy('id')->take(5)->get();
        foreach($videos as $video) {
            $video->commentSize = count($video->comments);
        }

        $trending = DB::select(
            'select r.id as id,
                    r.name as name, 
                    r.text as text, 
                    r.difficulty as difficulty, 
                    r.created_at as createdAt, 
                    r.image_url as image,
                    count(c.id) as comments 
            from recipes r
            left join comments c on c.recipe_id = r.id
            group by id, name, text, difficulty, createdAt, image
            order by comments desc limit 3');
        return view('index', compact('videos', 'trending'));
    }


    public function getUserInfo($id) {

        $user = User::findOrFail($id);
        return $user;
    }

    public function updateUserInfo(Request $request) {

        $request->validate([
            'id' => 'required|numeric',
            'name' => 'required|string|max:100',
            'email' => 'required|string|max:100',
            'password' => 'string|max:32',
            'image' => 'mimes:jpg,png,jpeg,svg'
        ]);

        $user = User::findOrFail($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password) {
            $user->password = Hash::make($request->password);
        }
        if ($request->hasFile('image')) {
            $destinationPath = '/images/profiles/';
            $imageName = request()->file('image')->getClientOriginalName();
            $filenameCover = time() . str_replace(' ', '_', $imageName);;
            request()->file('image')->move(public_path() . $destinationPath, $filenameCover);
            $user->image = $destinationPath . $filenameCover;
        }

        $user->save();
        return response('Success', 200);
    }

    public function recipes() {
        $recipes = Recipe::where('active', true)->paginate(5);
        return view('recipes', compact('recipes'));
    }
    public function videos() {
        $videos = Video::where('active', true)->paginate(5);
        return view('video', compact('videos'));
    }
    public function search(){
        $result = array();
        return view('search', compact('result'));
    }

    public function searchByTerm(Request $request) {

        if($request->type != '' && $request->term != '')  {

            switch($request->type) {

                case 'web':

                    switch($request->web_type) {

                        case 'yahoo': 
                            return Redirect::to('https://search.yahoo.com/search?p=' . $request->term . '&fr=yfp-t&fp=1&toggle=1&cop=mss&ei=UTF-8');
                
                        break;

                        case 'google': 
                            return Redirect::to('https://google.com/search?q=' . $request->term);
                        break;

                        case 'bing': 
                            return Redirect::to('https://www.bing.com/search?q=' . $request->term . '&form=QBLH&sp=-1&pq=pas&sc=8-3&qs=n&sk=&cvid=DF185551F29947438D79CC7302446644');
                        break;

                        default: 
                    }

                break;

                case 'db':  
 
                    switch($request->db_type) {

                        case 'video':
                            $result = DB::table('videos')->leftJoin('categories', 'videos.category_id', 'categories.id')
                            ->leftJoin('comments', 'comments.video_id', 'videos.id')
                            ->where('videos.active', true)
                            ->where('videos.name', 'like', '%' . $request->term .'%')
                            ->orWhere('videos.description', 'like', '%' . $request->term . '%')
                            ->selectRaw('videos.id as id, videos.name as title, videos.description as description, categories.name as diff, 
                            videos.image as image, videos.created_at as created_at, "video" as type, count(comments.id) as comments')
                            ->groupBy('id', 'title', 'description', 'diff', 'image', 'created_at', 'type')
                            ->paginate(5);
                            return view('searched', compact('result'));
                        break;

                        case 'recipe':
                            $result = DB::table('recipes')->leftJoin('comments', 'comments.recipe_id', 'comments.id')
                            ->where('recipes.active', true)
                            ->where('recipes.name', 'like', '%' . $request->term . '%')
                            ->Orwhere('recipes.text', 'like', '%' . $request->term . '%')
                            ->selectRaw('recipes.id as id, recipes.name as title,  recipes.text as description, recipes.difficulty as diff,
                            recipes.image_url as image, recipes.created_at as created_at, "recipe" as type, count(comments.id) as comments')
                            ->groupBy('id','title', 'description', 'diff', 'image', 'created_at', 'type')
                            ->paginate(5);
                            return view('searched', compact('result'));
                        break;

                        default: abort(404);
                    }
                
                    
                break;

                default: abort('500', 'Servis nije dostupan');
            }
        }

    

    }
    public function recipeView($id){
        
        $recipe = Recipe::whereActive(true)->whereId($id)->first();
        return view('recept', compact('recipe'));
    }
    public function videoView($id){

        $video = Video::whereActive(true)->whereId($id)->first();
        return view('emisija', compact('video'));
    }


    public function createComment(Request $request) {
        $request->validate([
            'id' => 'required',
            'type' => 'required',
            'text' => 'required|string|max:500'
        ],
    [
        'text.required' => 'Morate unijeti tekst komentara',
        'text.max' => 'Komentar moze sadrzati najvise 500 karaktera.'
    ]);

        switch($request->type) {
            case 'video':
                Comment::create([
                    'text' => $request->text,
                    'user_id' => Auth::id(),
                    'video_id' => $request->id
                ]);

                return response('success', 200);
            break;

            case 'recipe': 
                Comment::create([
                    'text' => $request->text,
                    'user_id' => Auth::id(),
                    'recipe_id' => $request->id
                ]);

                return response('success', 200);
            break;

            default: abort(404, 'Tip nije validan');
        }
    }

    public function getByCategory($type) {

        if($type != '' && $type != null) {

            switch($type) {
                case 'predjelo': 
                    $result = Video::where('category_id', Category::where('name', 'Predjelo')->first()->id)->where('active', true)->paginate(5);
                    return view('category', compact('result'));
                break;

                case 'glavno-jelo': 
                    $result = Video::where('category_id', Category::where('name', 'Glavno jelo')->first()->id)->where('active', true)->paginate(5);
                    return view('category', compact('result'));
                break;

                case 'dezert': 
                    $result = Video::where('category_id', Category::where('name', 'Dezert')->first()->id)->where('active', true)->paginate(5);
                    return view('category', compact('result'));
                break;

                default: abort(404, 'Kategorija nije pronadjena!');
            }
        }
    }

    public function description() {
        return view('opis');
    }
    public function downloadDocument() {

        return response()->download('putanjna do fajla');
    }
}
