<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // Import the base Controller
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class EventAdminController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        $partners = User::all(); // Fetch all users as potential partners
        return view('admin.events.create', compact('partners'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'location' => 'required',
            'partner_id' => 'required|exists:users,id', // Ensure the partner_id is a valid user
        ]);

        Event::create($validated);
        return redirect()->route('admin.events.index');
    }

    public function show(Event $event)
    {
        return view('admin.events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $partners = User::all(); // Fetch all users as potential partners
        return view('admin.events.edit', compact('event', 'partners'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'location' => 'required',
            'partner_id' => 'required|exists:users,id', // Validate partner_id if needed
        ]);

        $event->update($validated);
        return redirect()->route('admin.events.index');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index');
    }
}
