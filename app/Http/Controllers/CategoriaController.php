<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        //OBTENGO TODAS LAS CATEGORIAS
        $categorias = Categoria::all();

        //RETORNO LA VISTA
        return view('ferreteria.add_categoria', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('ferreteria.add_categoria');
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

        $categoria = new Categoria([

            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        $categoria->save();
        return back()->with('message', 'Categoria Creada con Exito');
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
        $categoria = Categoria::find($id);
        return view('ferreteria.add_categoria', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $categoria = Categoria::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Manejar el caso en que el ID no sea válido (por ejemplo, redireccionar con un mensaje de error)
            return redirect()->back()->with('error', 'Categoría no encontrada');
        }

        // Resto del código de actualización aquí...
        $categoria = Categoria::find($id);

        $validate = $request->validate([
            'nombre' => 'required|string|max:50',
            'descripcion' => 'nullable|string|max:200',
            'estado' => 'required',
        ]);

        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->estado = $request->estado;
        $categoria->save();

        return back()->with('message', 'Categoria Actualizada con Éxito!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Validar y encontrar la categoría por ID
            $categoria = Categoria::findOrFail($id);

            // Eliminar la categoría
            $categoria->delete();

            return back()->with('message', 'Categoría Eliminada con Éxito');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Manejar el caso en que el ID no sea válido (por ejemplo, redireccionar con un mensaje de error)
            return redirect()->back()->with('error', 'Categoría no encontrada');
        } catch (\Exception $e) {
            // Manejar cualquier otro error durante la eliminación y mostrar un mensaje de error
            return back()->with('error', 'No se pudo eliminar la categoría');
        }
    }
}
