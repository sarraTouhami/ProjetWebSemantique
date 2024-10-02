<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::all(); // Récupère toutes les réservations

        return view('reservations.index', compact('reservations')); // Renvoie la vue avec les réservations
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reservations.create');
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
            'beneficiare_id' => 'required|integer',
            'don_id' => 'required|integer',
            'date_reservation' => 'required|date',
            'statut_reservation' => 'required|in:en_attente,confirmé,completé,annulee',
        ]);

        Reservation::create($request->all());

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reservation = Reservation::findOrFail($id); 
        return view('reservations.show', compact('reservation')); 
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id); 
        return view('reservations.edit', compact('reservation'));
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
            'beneficiare_id' => 'required|integer',
            'don_id' => 'required|integer',
            'date_reservation' => 'required|date',
            'statut_reservation' => 'required|in:en_attente,confirmé,completé,annulee',
        ]);
        $reservation = Reservation::find($id);
        $reservation->update($request->all());

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id); 
        $reservation->delete(); 
    
        return redirect()->route('reservations.index')
            ->with('success', 'Reservation deleted successfully.');
    }
    
}
