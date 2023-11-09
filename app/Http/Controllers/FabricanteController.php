<?php

namespace App\Http\Controllers;

use App\Models\Fabricante;
use Illuminate\Http\Request;

class FabricanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        //OBTENGO TODAS LAS fabricanteS
        $fabricantes = Fabricante::all();

        //RETORNO LA VISTA
        return view('ferreteria.fabricante.add_fabricante', compact('fabricantes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('ferreteria.fabricante.add_fabricante');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = $request->validate([
            'nombre' => 'required|string|max:50',
            'descripcion' => 'nullable|string|max:220'
        ]);

        $fabricante = new fabricante([

            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        $fabricante->save();
        return back()->with('message', 'fabricante Creado con Exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $fabricante = fabricante::find($id);
        return view('ferreteria.fabricante.add_fabricante', compact('fabricante'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $fabricante = fabricante::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Manejar el caso en que el ID no sea válido (por ejemplo, redireccionar con un mensaje de error)
            return redirect()->back()->with('error', 'Fabricante no encontrado');
        }

        // Resto del código de actualización aquí...
        $fabricante = fabricante::find($id);

        $validate = $request->validate([
            'nombre' => 'required|string|max:50',
            'descripcion' => 'nullable|string|max:200',
            'estado' => 'required',
        ]);

        $fabricante->nombre = $request->nombre;
        $fabricante->descripcion = $request->descripcion;
        $fabricante->estado = $request->estado;
        $fabricante->save();

        return back()->with('message', 'fabricante Actualizado con Éxito!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Validar y encontrar la categoría por ID
            $fabricante = fabricante::findOrFail($id);

            // Eliminar la categoría
            $fabricante->delete();

            return back()->with('message', 'Fabricante Eliminado con Éxito');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Manejar el caso en que el ID no sea válido (por ejemplo, redireccionar con un mensaje de error)
            return redirect()->back()->with('error', 'Fabricante no encontrado');
        } catch (\Exception $e) {
            // Manejar cualquier otro error durante la eliminación y mostrar un mensaje de error
            return back()->with('error', 'No se pudo eliminar el Fabricante');
        }
    }
}
