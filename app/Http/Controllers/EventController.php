<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        $partners = User::all(); // Fetch all users as potential partners
        return view('events.create', compact('partners'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'location' => 'required',
            'partner_id' => 'required|exists:users,id',
        ]);

        Event::create($validated);
        return redirect()->route('events.index');
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $partners = User::all(); // Fetch all users as potential partners
        return view('events.edit', compact('event', 'partners'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'location' => 'required',
        ]);

        $event->update($validated);
        return redirect()->route('events.index');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index');
    }
}
