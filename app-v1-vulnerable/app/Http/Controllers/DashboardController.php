<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\FileModel;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::count();
        $comments = Comment::count();
        $files = FileModel::count();

        return view('dashboard', compact('users', 'comments', 'files'));
    }
}
