<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // Import the base Controller
use App\Models\Recommendation;
use Illuminate\Http\Request;

class RecommendationAdminController extends Controller
{
    public function index()
    {
        $recommendations = Recommendation::all();
        return view('admin.recommendations.index', compact('recommendations'));
    }

    public function create()
    {
        return view('admin.recommendations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'contenu' => 'required',
            'type' => 'required|in:conservation,gestion des portions',
            'applicable_a' => 'required|in:donateur,bénéficiaire',
            'user_id' => 'required|exists:users,id', // Ensure user_id exists in the users table
        ]);

        Recommendation::create($validated);
        return redirect()->route('admin.recommendations.index');
    }

    public function show(Recommendation $recommendation)
    {
        return view('admin.recommendations.show', compact('recommendation'));
    }

    public function edit(Recommendation $recommendation)
    {
        return view('admin.recommendations.edit', compact('recommendation'));
    }

    public function update(Request $request, Recommendation $recommendation)
    {
        $validated = $request->validate([
            'contenu' => 'required',
            'type' => 'required|in:conservation,gestion des portions',
            'applicable_a' => 'required|in:donateur,bénéficiaire',
        ]);

        $recommendation->update($validated);
        return redirect()->route('admin.recommendations.index');
    }

    public function destroy(Recommendation $recommendation)
    {
        $recommendation->delete();
        return redirect()->route('admin.recommendations.index');
    }
}
