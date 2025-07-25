<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class RestauranteController extends Controller
{

    // Devolvemos todos los restaurantes
    public function index()
    {
        $restaurantes = Restaurante::all();

        // Devolvemos una respuesta correcta siempre ya que la petición se ha realizado correctamente
        return response()->json([
            'success' => true,
            'data' => $restaurantes->isEmpty() ? 'No se han encontrado restaurantes' : $restaurantes ,
            'message' => 'Lista de restaurantes'
        ]);
    }

    // Almacenamos un restaurante
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:10',
        ]);

        $restaurante = Restaurante::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $restaurante,
            'message' => 'Restaurante creado correctamente'
        ], 201);
    }


    // Mostramos un único restaurante por id
    public function show(string $id)
    {
        $restaurante = Restaurante::find($id);

        if (!$restaurante) {
            return response()->json([
                'success' => false,
                'message' => 'Restaurante no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $restaurante,
            'message' => 'Restaurante encontrado'
        ]);
    }

    // Actualizamos un restaurante por id
    public function update(Request $request, string $id)
    {
        try{
            $restaurante = Restaurante::findOrFail($id);

            $validatedData = $request->validate([
                'nombre' => 'sometimes|string|max:255',
                'direccion' => 'sometimes|string|max:255',
                'telefono' => 'sometimes|string|max:10',
            ]);

            $restaurante->update($validatedData);

            return response()->json([
                'success' => true,
                'data' => $restaurante,
                'message' => 'Restaurante actualizado correctamente'
            ]);
        }catch (ModelNotFoundException $e){
            return response()->json([
                'success' => false,
                'message' => 'Restaurante no encontrado'
            ], 404);
        }
    }


    // Eliminamos un restaurante por id
    public function destroy(string $id)
    {
        try {
            $restaurante = Restaurante::findOrFail($id);
            $restaurante->delete();

            return response()->json([
                'success' => true,
                'message' => 'Restaurante eliminado correctamente'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Restaurante no encontrado'
            ], 404);
        }
    }
}
