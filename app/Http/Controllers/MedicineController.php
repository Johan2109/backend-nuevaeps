<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MedicineController extends Controller
{
    // Obtener todos los medicamentos
    public function index()
    {
        return Medicine::all();
    }

    // Crear un nuevo medicamento
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'is_no_pos' => 'required|boolean',
        ]);

        $medicine = Medicine::create($validated);

        return response()->json($medicine, 201);
    }

    // Mostrar un medicamento específico
    public function show($id)
    {
        $medicine = Medicine::findOrFail($id);
        return response()->json($medicine);
    }

    // Actualizar un medicamento existente
    public function update(Request $request, $id)
    {
        $medicine = Medicine::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'is_no_pos' => 'sometimes|required|boolean',
        ]);

        $medicine->update($validated);

        return response()->json($medicine);
    }

    // Eliminar un medicamento
    public function destroy($id)
    {
        $medicine = Medicine::findOrFail($id);
        $medicine->delete();

        return response()->json(['message' => 'Medicamento eliminado correctamente.']);
    }
}
