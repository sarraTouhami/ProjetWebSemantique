<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

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
        // Get today's date
        $currentDate = now()->toDateString();
    
        // Fetch only posts created today
        $posts = Post::whereDate('created_at', $currentDate)->get();
    
        return view('home', compact('posts'));
    }
    

}
