<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'contenu' => 'required',
            'type_post' => 'required',
            'user_id' => 'required',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);
    
        // Initialize variable to store the image URL
        $imagePath = null;
    
        // Handle image upload
        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
    
            // Move the image to /storage/app/public/images
            $imagePath = $image->storeAs('public/images', $imageName);
    
            // Convert the storage path to a public URL
            $imagePath = str_replace('public/', 'storage/', $imagePath);
        }
    
        // Save post with the image URL if provided
        Post::create([
            'titre' => $request->input('titre'),
            'contenu' => $request->input('contenu'),
            'type_post' => $request->input('type_post'),
            'user_id' => $request->input('user_id'),
            'image_url' => $imagePath,  // Store the proper image path
        ]);
    
        return redirect()->route('posts.index')->with('success', 'Publication créée avec succès.');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'titre' => 'required',
            'contenu' => 'required',
            'type_post' => 'required',
            'user_id' => 'required',
        ]);

        $post = Post::find($id);
        $post->update($request->all());

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id)->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');

    }
}
