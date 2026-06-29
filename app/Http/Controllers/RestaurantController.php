<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RestaurantController extends Controller
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
        return Inertia::render('Create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validar os dados que vêm do formulário Vue
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cuisine_type' => 'required|string|max:255',
            'rating' => 'required|numeric|min:0|max:5',
            'review' => 'nullable|string',
        ]);

        // 2. Criar o registo colado ao ID do utilizador autenticado
        $request->user()->restaurants()->create($validated);

        // 3. Redirecionar de volta para a Dashboard
        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        // Garante que o utilizador só edita as suas próprias avaliações
        if ($restaurant->user_id !== auth()->id()) {
            abort(403);
        }

        return Inertia::render('Edit', [
            'item' => $restaurant,
            'type' => 'restaurant'
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        if ($restaurant->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cuisine_type' => 'required|string|max:255',
            'rating' => 'required|numeric|min:0|max:5',
            'review' => 'nullable|string',
        ]);

        $restaurant->update($validated);

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        if ($restaurant->user_id !== auth()->id()) {
            abort(403);
        }

        $restaurant->delete();

        return redirect()->route('dashboard');
    }
}