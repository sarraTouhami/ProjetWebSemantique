<?php

namespace App\Http\Controllers;

use App\Models\Recommendation;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function index()
    {
        $recommendations = Recommendation::all();
        return view('recommendations.index', compact('recommendations'));
    }

    public function create()
    {
        return view('recommendations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'contenu' => 'required',
            'type' => 'required|in:conservation,gestion des portions',
            'applicable_a' => 'required|in:donateur,bénéficiaire',
            'user_id' => 'required|exists:users,id',
        ]);

        Recommendation::create($validated);
        return redirect()->route('recommendations.index');
    }

    public function show(Recommendation $recommendation)
    {
        return view('recommendations.show', compact('recommendation'));
    }

    public function edit(Recommendation $recommendation)
    {
        return view('recommendations.edit', compact('recommendation'));
    }

    public function update(Request $request, Recommendation $recommendation)
    {
        $validated = $request->validate([
            'contenu' => 'required',
            'type' => 'required|in:conservation,gestion des portions',
            'applicable_a' => 'required|in:donateur,bénéficiaire',
        ]);

        $recommendation->update($validated);
        return redirect()->route('recommendations.index');
    }

    public function destroy(Recommendation $recommendation)
    {
        $recommendation->delete();
        return redirect()->route('recommendations.index');
    }
}
