<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */

  
    public function index()
    {
        //OBTENGO TODAS LAS proveedor
        $proveedores = Proveedor::all();

        //RETORNO LA VISTA
        return view('ferreteria.proveedor.add_proveedor', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('ferreteria.proveedor.add_proveedor');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = $request->validate([
            'nombre' => 'required|string|max:50',
            'nit' => 'required|numeric|digits:10',
            'direccion'=>'required|string|max:250',
            'telefono'=> 'required|numeric|digits:11',
            'correo_electronico'=>'required|string|unique:proveedors|email',
            'sitio_web' => 'nullable|string|max:250',
            'descripcion'=> 'nullable|string|max:250',
            'contacto_principal' => 'nullable|numeric|digits:11',
        ]);

        $proveedor = new proveedor([

            'nombre' => $request->nombre,
            'nit'=> $request->nit,
            'direccion'=>$request->direccion,
            'telefono'=>$request->telefono,
            'correo_electronico' =>$request->correo_electronico,
            'sitio_web'=> $request->sitio_web,
            'descripcion' => $request->descripcion,
            'contacto_principal'=>$request->contacto_principal

        ]);

        $proveedor->save();
        return back()->with('message', 'proveedor Creado con Exito');
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
        $proveedor = proveedor::find($id);
        return view('ferreteria.proveedor.add_proveedor', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $proveedor = proveedor::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Manejar el caso en que el ID no sea válido (por ejemplo, redireccionar con un mensaje de error)
            return redirect()->back()->with('error', 'Proveedor no encontrado');
        }

        // Resto del código de actualización aquí...
        $proveedor = proveedor::find($id);

        $validate = $request->validate([
            'nombre' => 'required|string|max:50',
            'nit' => 'required|numeric|digits:10',
            'direccion'=>'required|string|max:250',
            'telefono'=> 'required|numeric|digits:11',
            'correo_electronico'=>'required|string|email|unique:proveedors,correo_electronico,'. $id,
            'sitio_web' => 'nullable|string|max:250',
            'descripcion'=> 'nullable|string|max:250',
            'contacto_principal' => 'nullable|numeric|digits:11',
        ]);

        $proveedor->nombre = $request->nombre;
        $proveedor->nit = $request->nit;
        $proveedor->direccion = $request->direccion;
        $proveedor->telefono = $request->telefono;
        $proveedor->correo_electronico = $request->correo_electronico;
        $proveedor->sitio_web = $request->sitio_web;
        $proveedor->descripcion = $request->descripcion;
        $proveedor->contacto_principal = $request->contacto_principal;
        $proveedor->estado = $request->estado;
        $proveedor->save();

        return back()->with('message', 'proveedor Actualizado con Éxito!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Validar y encontrar la categoría por ID
            $proveedor = proveedor::findOrFail($id);

            // Eliminar la categoría
            $proveedor->delete();

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
