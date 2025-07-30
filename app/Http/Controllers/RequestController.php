<?php

namespace App\Http\Controllers;

use App\Models\Request as MedicineRequest;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class RequestController extends Controller
{
    // Listar todas las solicitudes del id especifico y paginadas
    public function index()
    {
        return MedicineRequest::with(['medicine', 'user'])
            ->where('user_id', Auth::id())
            ->paginate(10);
    }

    // Crear una nueva solicitud
    public function store(HttpRequest $request)
    {
        $validated = $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'order_number' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        $medicineRequest = MedicineRequest::create([
            'user_id' => Auth::id(),
            'medicine_id' => $validated['medicine_id'],
            'order_number' => $validated['order_number'] ?? null,
            'address' => $validated['address'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'email' => $validated['email'] ?? null,
        ]);

        return response()->json($medicineRequest->load(['medicine', 'user']), 201);
    }

    // Mostrar una solicitud específica
    public function show($id)
    {
        $request = MedicineRequest::with(['medicine', 'user'])->findOrFail($id);
        return response()->json($request);
    }

    // Actualizar una solicitud
    public function update(HttpRequest $request, $id)
    {
        $medicineRequest = MedicineRequest::findOrFail($id);

        if ($medicineRequest->user_id !== Auth::id()) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $validated = $request->validate([
            'medicine_id' => 'sometimes|exists:medicines,id',
            'order_number' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        $medicineRequest->update($validated);

        return response()->json($medicineRequest->load(['medicine', 'user']));
    }

    // Eliminar una solicitud
    public function destroy($id)
    {
        $medicineRequest = MedicineRequest::findOrFail($id);

        if ($medicineRequest->user_id !== Auth::id()) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $medicineRequest->delete();

        return response()->json(['message' => 'Solicitud eliminada correctamente.']);
    }
}
