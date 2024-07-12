<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        $posts = Auth::user()->posts()->latest()->paginate(6);
        return view('users.dashboard', ['posts' => $posts]);
    }

    public function userPosts(User $user)
    {
        $userPosts = $user->posts()->latest()->paginate(6);
        return view('users.posts', ['posts' => $userPosts]);
    }
}
