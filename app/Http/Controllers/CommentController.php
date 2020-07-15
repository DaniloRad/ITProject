<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::where('active', true)->paginate(5);
        return view('admin.comments.index', compact('comments'));
    }

    public function deleteComment($id) {

        if($id == '' || $id == null) {
            abort(500, 'Morate da predate ID komentara');
        } else {
            $comment = Comment::findOrFail($id);
            $comment->active = false;
            $comment->save();
            return redirect()->back();
        }
    }
}
