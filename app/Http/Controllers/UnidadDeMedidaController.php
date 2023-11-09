<?php

namespace App\Http\Controllers;

use App\Models\UnidadDeMedida;
use Illuminate\Http\Request;

class UnidadDeMedidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        //OBTENGO TODAS LAS unidad_de_medidaS
        $unidad_de_medidas = UnidadDeMedida::all();

        //RETORNO LA VISTA
        return view('ferreteria.unidad_de_medida.add_unidad_de_medida', compact('unidad_de_medidas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('ferreteria.unidad_de_medida.add_unidad_de_medida');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = $request->validate([
            'nombre' => 'required|string|max:50',
            'abreviatura' => 'required|string|max:10',
            'conversion' => 'required|regex:/^\d+(\.\d{2})?$/'
        ]);

        $unidad_de_medida = new UnidadDeMedida([

            'nombre' => $request->nombre,
            'abreviatura' => $request->abreviatura,
            'conversion' => $request->conversion
        ]);

        $unidad_de_medida->save();
        return back()->with('message', 'Unidad de Medida Creada con Exito');
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
        $unidad_de_medida = UnidadDeMedida::find($id);
        return view('ferreteria.unidad_de_medida.add_unidad_de_medida', compact('unidad_de_medida'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $unidad_de_medida = UnidadDeMedida::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Manejar el caso en que el ID no sea válido (por ejemplo, redireccionar con un mensaje de error)
            return redirect()->back()->with('error', 'Unidad de Medida no encontrada');
        }

        // Resto del código de actualización aquí...
        $unidad_de_medida = UnidadDeMedida::find($id);

        $validate = $request->validate([
            'nombre' => 'required|string|max:50',
            'abreviatura' => 'required|string|max:10',
            'conversion' => 'required|regex:/^\d+(\.\d{2})?$/',
            'estado' => 'required',
        ]);

        $unidad_de_medida->nombre = $request->nombre;
        $unidad_de_medida->abreviatura = $request->abreviatura;
        $unidad_de_medida->conversion = $request->conversion;
        $unidad_de_medida->estado = $request->estado;
        $unidad_de_medida->save();

        return back()->with('message', 'Unidad de Medida Actualizada con Éxito!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Validar y encontrar la categoría por ID
            $unidad_de_medida = UnidadDeMedida::findOrFail($id);

            // Eliminar la categoría
            $unidad_de_medida->delete();

            return back()->with('message', 'Unidad de Medida Eliminada con Éxito');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Manejar el caso en que el ID no sea válido (por ejemplo, redireccionar con un mensaje de error)
            return redirect()->back()->with('error', 'Unidad de Medida no encontrada');
        } catch (\Exception $e) {
            // Manejar cualquier otro error durante la eliminación y mostrar un mensaje de error
            return back()->with('error', 'No se pudo eliminar la unidad de medida');
        }
    }
}
