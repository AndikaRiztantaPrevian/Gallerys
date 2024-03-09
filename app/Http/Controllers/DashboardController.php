<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $post = Post::inRandomOrder()->get();
        return view('dashboard', compact('post'));
    }
}
