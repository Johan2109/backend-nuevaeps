<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    // Listar todos los usuarios paginados
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        $users = User::select('id', 'name', 'email', 'created_at')
            ->paginate($perPage);

        return response()->json($users);
    }

    // Mostrar un usuario por ID
    public function show($id)
    {
        $user = User::select('id', 'name', 'email', 'created_at')
            ->findOrFail($id);

        return response()->json($user);
    }
}
