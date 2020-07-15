<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $roles = Role::all();
        $users = User::where('active', true)->paginate(5);
        return view('admin.index', compact('users', 'roles'));
    }

    public function deleteUser($id) {

        if($id == '' || $id == null) {
            abort(500, 'Morate da predate ID korisnika');
        } else {
           $user = User::findOrFail($id);
            $user->active = false;
            $user->save();
            return redirect()->back();
        }
    }

    public function addUser(Request $request) {

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|max:100',
            'password' => 'required|string|min:8|max:20',
            'role' => 'required',
            'image' => 'mimes:jpg,jpeg,png'
        ]);
        
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role;
        
        if (request()->hasFile('image')) {
            $destinationPath = '/images/profile/';
            $imageName = request()->file('image')->getClientOriginalName();
            $filenameCover = time() . str_replace(' ', '_', $imageName);;
            request()->file('image')->move(public_path() . $destinationPath, $filenameCover);
            $user->image = $destinationPath . $filenameCover;
        }

        $user->save();
        return redirect()->back();
    }

    public function editUser($id) {

        $roles = Role::all();
        $user = User::findOrFail($id);
        return view('admin.edit', compact('user', 'roles'));
    }

    public function updateUser(Request $request) {

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|max:100',
            'password' => 'nullable|string|min:8|max:20',
            'role' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png'
        ]);

        $user = User::findOrFail($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password != null || $request != '') {
            $user->password = Hash::make($request->password);
        }
        $user->role_id = $request->role;
        
        if (request()->hasFile('image')) {
            $destinationPath = '/images/profile/';
            $imageName = request()->file('image')->getClientOriginalName();
            $filenameCover = time() . str_replace(' ', '_', $imageName);;
            request()->file('image')->move(public_path() . $destinationPath, $filenameCover);
            $user->image = $destinationPath . $filenameCover;
        }

        $user->save();
        return redirect('/home');
    }
    
}
