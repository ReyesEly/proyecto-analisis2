@extends('adminlte::page')

@section('title', 'Proveedores')

@section('content_header')


@stop

@section('content')
    <div class="card">

        <div class="class-header d-flex justify-content-between">
            <h2 class="m-2">PROVEEDORES</h2>
            @can('Crear')
                <x-adminlte-button label="Nuevo" theme="primary" icon="fas fa-solid fa-plus" class="m-3" data-toggle="modal"
                    data-target="#modalCrear" />
            @endcan


        </div>
        <hr>
        <div class="card-body">
            @php
                $heads = ['ID', 'NOMBRE', 'NIT', 'DIRECCION', 'TELEFONO', 'CORREO', 'CONTACTO', 'ESTADO', ['label' => 'Actions', 'no-export' => true, 'width' => 15]];

                $btnDelete = '<button  type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                    <i class="fa fa-lg fa-fw fa-trash"></i>
                </button>';
                $config = [
                    'language' => [
                        'url' => '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                    ],
                ];
            @endphp

            <x-adminlte-datatable id="table5" :heads="$heads" :config="$config" theme="light" striped hoverable>
                @foreach ($proveedores as $proveedor)
                    <tr>
                        <td>{{ $proveedor->id }}</td>
                        <td>{{ $proveedor->nombre }}</td>
                        <td>{{ $proveedor->nit }}</td>
                        <td>{{ $proveedor->direccion }}</td>
                        <td>{{ $proveedor->telefono }}</td>
                        <td>{{ $proveedor->correo_electronico }}</td>
                        <td>{{ $proveedor->contacto_principal }}</td>
                        <td>{{ $proveedor->estado }}</td>
                        <td>
                            @can('Actualizar')
                                <a class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit" data-toggle="modal"
                                    data-target="#modalActualizar{{ $proveedor->id }}">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </a>
                            @endcan
                            @can('Eliminar')
                                <form style="display: inline;" action="{{ route('proveedor.destroy', $proveedor) }}"
                                    method="POST" class="formEliminar">
                                    @csrf
                                    @method('delete')
                                    {!! $btnDelete !!}
                                </form>
                            @endcan

                        </td>
                    </tr>

                    {{-- Themed --}}
                    <x-adminlte-modal id="modalActualizar{{ $proveedor->id }}" title="Editando proveedor" theme="primary"
                        icon="fas fa-solid fa-edit" size='lg' disable-animations class="center">
                        <form action="{{ route('proveedor.update', $proveedor) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- NOMBRE -->
                                    <x-adminlte-input type="text" name="nombre" label="NOMBRE"
                                        label-class="text-lightblue" value="{{ $proveedor->nombre }}">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fas fa-solid fa-user text-lightblue"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                </div>
                                <div class="col-md-6">

                                    <x-adminlte-input type="text" name="nit" label="NIT"
                                        label-class="text-lightblue" value="{{ $proveedor->nit }}">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fas fa-solid fa-address-card text-lightblue"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                </div>

                                <div class="col-md-6">

                                    <x-adminlte-input type="text" name="direccion" label="DIRECCION"
                                        label-class="text-lightblue" value="{{ $proveedor->direccion }}">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fas fa-solid fa-file-signature text-lightblue"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                </div>

                                <div class="col-md-6">

                                    <x-adminlte-input type="text" name="telefono" label="TELEFONO"
                                        label-class="text-lightblue" value="{{ $proveedor->telefono }}">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fas fa-solid fa-phone text-lightblue"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                </div>

                                <div class="col-md-6">

                                    <x-adminlte-input type="text" name="correo_electronico" label="CORREO ELECTRONICO"
                                        label-class="text-lightblue" value="{{ $proveedor->correo_electronico }}">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fas fa-solid fa-envelope text-lightblue"></i>

                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                </div>
                                <div class="col-md-6">

                                    <x-adminlte-input type="text" name="sitio_web" label="SITIO WEB"
                                        label-class="text-lightblue" value="{{ $proveedor->sitio_web }}">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fas fa-solid fa-globe text-lightblue"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                </div>

                                <div class="col-md-6">
                                    <!-- DESCRIPCION -->
                                    <x-adminlte-input type="text" name="descripcion" label="Descripcion"
                                        label-class="text-lightblue" value="{{ $proveedor->descripcion }}">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fas fa-solid fa-file-signature text-lightblue"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                </div>

                                <div class="col-md-6">

                                    <x-adminlte-input type="text" name="contacto_principal" label="CONTACTO PRINCIPAL"
                                        label-class="text-lightblue" value="{{ $proveedor->contacto_principal }}">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fas fa-solid fa-tty text-lightblue"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                </div>

                                <div class="col-md-12">
                                    <x-adminlte-select name="estado" label="ESTADO" label-class="text-lightblue"
                                        igroup-size="lg">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-gradient-info">
                                                <i class="fas fa-regular fa-eye-slash"></i>
                                            </div>

                                        </x-slot>

                                        <option value="{{ $proveedor->id }}">{{ $proveedor->estado }}</option>
                                        <option value="Inactivo">Inactivo</option>
                                        <option value="Activo">Activo</option>
                                    </x-adminlte-select>
                                </div>
                            </div>
                            <x-adminlte-button class="btn-flat" type="submit" label="ACTUALIZAR" theme="primary"
                                icon="fas fa-lg fa-save" />
                        </form>
                    </x-adminlte-modal>
                @endforeach
            </x-adminlte-datatable>
        </div>
    </div>

    {{-- Themed --}}
    <x-adminlte-modal id="modalCrear" title="Creando proveedor" theme="primary" icon="fas fa-solid fa-plus"
        size='lg' disable-animations class="center">
        <form action="{{ route('proveedor.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <!-- NOMBRE -->
                    <x-adminlte-input type="text" name="nombre" label="NOMBRE" placeholder="INGRESA EL NOMBRE"
                        label-class="text-lightblue" value="{{ old('nombre') }}">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-solid fa-user text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>

                <div class="col-md-6">
                    <!-- NOMBRE -->
                    <x-adminlte-input type="text" name="nit" label="NIT" placeholder="INGRESA EL NIT"
                        label-class="text-lightblue" value="{{ old('nit') }}">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-solid fa-address-card text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>


                <div class="col-md-6">
                    <!-- NOMBRE -->
                    <x-adminlte-input type="text" name="direccion" label="DIRECCION"
                        placeholder="INGRESA LA DIRECCION" label-class="text-lightblue" value="{{ old('direccion') }}">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-solid fa-file-signature text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>

                <div class="col-md-6">
                    <!-- NOMBRE -->
                    <x-adminlte-input type="text" name="telefono" label="TELEFONO" placeholder="INGRESA EL TELEFONO"
                        label-class="text-lightblue" value="{{ old('telefono') }}">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-solid fa-phone text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>

                <div class="col-md-6">
                    <!-- NOMBRE -->
                    <x-adminlte-input type="text" name="correo_electronico" label="CORREO"
                        placeholder="INGRESA EL CORREO" label-class="text-lightblue"
                        value="{{ old('correo_electronico') }}">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-solid fa-envelope text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>

                <div class="col-md-6">
                    <!-- NOMBRE -->
                    <x-adminlte-input type="text" name="sitio_web" label="SITIO WEB"
                        placeholder="INGRESA EL SITIO WEB" label-class="text-lightblue" value="{{ old('sitio_web') }}">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-solid fa-globe text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
                <!-- DESCRIPCION -->
                <div class="col-md-6">
                    <x-adminlte-input type="text" name="descripcion" label="Descripcion"
                        placeholder="INGRESA LA DESCRIPCION (OPCIONAL)" label-class="text-lightblue"
                        value="{{ old('descripcion') }}">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-solid fa-file-signature text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>

                <div class="col-md-6">
                    <!-- NOMBRE -->
                    <x-adminlte-input type="text" name="contacto_principal" label="CONTACTO PRINCIPAL"
                        placeholder="INGRESA EL CONTACTO PRINCIPAL (OPCIONAL)" label-class="text-lightblue"
                        value="{{ old('contacto_principal') }}">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-solid fa-tty  text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
            </div>
            <x-adminlte-button class="btn-flat" type="submit" label="Guardar" theme="primary"
                icon="fas fa-lg fa-save" />
        </form>
    </x-adminlte-modal>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.formEliminar').submit(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Estas Seguro?',
                    text: "Eliminaras un Registro!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Eliminano!',
                            'Registro borrado con exito.',
                            'success'

                        )
                        this.submit();
                    }
                })
            });
        });
    </script>

    @if (session('message'))
        <script>
            $(document).ready(function() {
                let $message = "{{ session('message') }}";
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: $message,
                    showConfirmButton: true,
                    timer: 3000
                })
            });
        </script>
    @endif

@stop
