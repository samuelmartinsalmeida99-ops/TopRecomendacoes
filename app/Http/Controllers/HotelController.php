<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validar os dados
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'rating' => 'required|numeric|min:0|max:5',
            'review' => 'nullable|string',
        ]);

        // 2. Criar o registo de hotel para o utilizador
        $request->user()->hotels()->create($validated);

        // 3. Redirecionar de volta para a Dashboard
        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hotel $hotel)
    {
        if ($hotel->user_id !== auth()->id()) {
            abort(403);
        }

        return Inertia::render('Edit', [
            'item' => $hotel,
            'type' => 'hotel'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hotel $hotel)
    {
        if ($hotel->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'rating' => 'required|numeric|min:0|max:5',
            'review' => 'nullable|string',
        ]);

        $hotel->update($validated);

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        if ($hotel->user_id !== auth()->id()) {
            abort(403);
        }

        $hotel->delete();

        return redirect()->route('dashboard');
    }
}
