<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedbacks = Feedback::all(); 

        return view('admin.feedbacks.index', compact('feedbacks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.feedbacks.create');
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
            'user_id' => 'required|integer',
            'type_feedback' => 'required|in:don,evenement,reservation', // Enumération de type_feedback
            'contenu_feedback' => 'required|string',
        ]);

        Feedback::create($request->all()); // Crée un nouveau feedback

        return redirect()->route('admin.feedbacks.index')
            ->with('success', 'Feedback created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $feedback = Feedback::findOrFail($id); 
        return view('admin.feedbacks.show', compact('feedback'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feedback = Feedback::findOrFail($id); 
        return view('admin.feedbacks.edit', compact('feedback'));
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
        // Valider les données
        $request->validate([
            'user_id' => 'required|integer',
            'type_feedback' => 'required|string|in:don,evenement,reservation',
            'contenu_feedback' => 'required|string',
        ]);
        
        // Mettre à jour le feedback
        $feedback = Feedback::findOrFail($id);
        $feedback->update($request->all());

        return redirect()->route('admin.feedbacks.index')
            ->with('success', 'Feedback updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id); 
        $feedback->delete(); 

        return redirect()->route('admin.feedbacks.index')
            ->with('success', 'Feedback deleted successfully.');
    }
}
