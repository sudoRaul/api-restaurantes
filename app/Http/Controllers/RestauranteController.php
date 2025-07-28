<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class RestauranteController extends Controller
{

    /**
     * @group Restaurantes
     *
     * Obtener el listado de todos los restaurantes
     *
     * @response 200 {
     *   "success": true,
     *   "data": [
     *     {
     *       "id": 1,
     *       "nombre": "Casa Paco",
     *       "direccion": "Calle Falsa 123",
     *       "telefono": "600123123"
     *     }
     *   ],
     *   "message": "Lista de restaurantes"
     * }
     */
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


    /**
     * Crear un nuevo restaurante
     *
     * Guarda un nuevo restaurante con nombre, dirección y teléfono
     *
     * @group Restaurantes
     *
     * @bodyParam nombre string required Nombre del restaurante. Example: Casa Juan
     * @bodyParam direccion string required Dirección del restaurante. Example: Calle Ejemplo 123
     * @bodyParam telefono integer required Teléfono del restaurante. Example: 666777888
     *
     * @response 201 {
     *   "success": true,
     *   "data": {
     *     "id": 2,
     *     "nombre": "Casa Juan",
     *     "direccion": "Calle Falsa 123",
     *     "telefono": "666777888"
     *   },
     *   "message": "Restaurante creado correctamente"
     * }
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|integer|max:10',
        ]);

        $restaurante = Restaurante::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $restaurante,
            'message' => 'Restaurante creado correctamente'
        ], 201);
    }


    /**
     * Mostrar un restaurante
     *
     * Devuelve los datos de un restaurante por su ID
     *
     * @group Restaurantes
     *
     * @urlParam id integer required ID del restaurante. Example: 1
     *
     * @response 200 {
     *   "success": true,
     *   "data": {
     *     "id": 1,
     *     "nombre": "Casa Juan",
     *     "direccion": "Calle Falsa 123",
     *     "telefono": "666777888"
     *   },
     *   "message": "Restaurante encontrado"
     * }
     *
     * @response 404 {
     *   "success": false,
     *   "message": "Restaurante no encontrado"
     * }
     */
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
        ], 200);
    }

    /**
     * Actualizar un restaurante
     *
     * Modifica los datos de un restaurante específico
     *
     * @group Restaurantes
     *
     * @urlParam id integer required ID del restaurante. Example: 1
     * @bodyParam nombre string Nombre del restaurante. Example: Casa Juan
     * @bodyParam direccion string Dirección del restaurante. Example: Calle Falsa 123
     * @bodyParam telefono string Teléfono del restaurante. Example: 666777888
     *
     * @response 200 {
     *   "success": true,
     *   "data": {
     *     "id": 1,
     *     "nombre": "Nuevo Nombre",
     *     "direccion": "Nueva Dirección",
     *     "telefono": "123456789"
     *   },
     *   "message": "Restaurante actualizado correctamente"
     * }
     */
    public function update(Request $request, string $id)
    {
        try{
            $restaurante = Restaurante::findOrFail($id);

            $validatedData = $request->validate([
                'nombre' => 'sometimes|string|max:255',
                'direccion' => 'sometimes|string|max:255',
                'telefono' => 'sometimes|integer|max:10',
            ]);

            $restaurante->update($validatedData);

            return response()->json([
                'success' => true,
                'data' => $restaurante,
                'message' => 'Restaurante actualizado correctamente'
            ], 200);
        }catch (ModelNotFoundException $e){
            return response()->json([
                'success' => false,
                'message' => 'Restaurante no encontrado'
            ], 404);
        }
    }


    /**
     * Eliminar un restaurante
     *
     * Elimina un restaurante específico
     *
     * @group Restaurantes
     *
     * @urlParam id integer required ID del restaurante. Example: 1
     *
     * @response 200 {
     *   "success": true,
     *   "message": "Restaurante eliminado correctamente"
     * }
     *
     * @response 404 {
     *   "success": false,
     *   "message": "Restaurante no encontrado"
     * }
     */
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
