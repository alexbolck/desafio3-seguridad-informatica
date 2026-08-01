<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::orderBy('created_at', 'desc')->get();
        return view('comments.index', compact('comments'));
    }

    public function store(Request $request)
    {
        // FIX: XSS corregido; el contenido se guarda y se renderiza escapado por Blade
        $comment = new Comment();
        $comment->user_id = auth()->id() ?? 1;
        $comment->body = $request->input('body');
        $comment->save();

        return redirect('/comments');
    }
}
