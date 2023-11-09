@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')


@stop

@section('content')
    <div class="card">

        <div class="class-header d-flex justify-content-between">
            <h2 class="m-2">CATEGORIAS</h2>
            @can('Crear')
            <x-adminlte-button label="Nueva" theme="primary" icon="fas fa-solid fa-plus" class="m-3" data-toggle="modal"
            data-target="#modalCrear" />
            @endcan
           

        </div>
        <hr>
        <div class="card-body">
            @php
                $heads = ['ID', 'NOMBRE', 'DESCRIPCION', 'ESTADO', ['label' => 'Actions', 'no-export' => true, 'width' => 15]];

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
                @foreach ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id }}</td>
                        <td>{{ $categoria->nombre }}</td>
                        <td>{{ $categoria->descripcion }}</td>
                        <td>{{ $categoria->estado }}</td>
                        <td>
                            @can('Actualizar')
                                <a class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit" data-toggle="modal"
                                    data-target="#modalActualizar{{ $categoria->id }}">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </a>
                            @endcan
                            @can('Eliminar')
                                <form style="display: inline;" action="{{ route('categoria.destroy', $categoria) }}"
                                    method="POST" class="formEliminar">
                                    @csrf
                                    @method('delete')
                                    {!! $btnDelete !!}
                                </form>
                            @endcan

                        </td>
                    </tr>

                    {{-- Themed --}}
                    <x-adminlte-modal id="modalActualizar{{ $categoria->id }}" title="Editando Categoria" theme="primary"
                        icon="fas fa-solid fa-edit" size='lg' disable-animations class="center">
                        <form action="{{ route('categoria.update', $categoria) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- NOMBRE -->
                                    <x-adminlte-input type="text" name="nombre" label="NOMBRE"
                                        label-class="text-lightblue" value="{{ $categoria->nombre }}">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fas fa-solid fa-file-signature text-lightblue"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                </div>

                                <div class="col-md-6">
                                    <!-- DESCRIPCION -->
                                    <x-adminlte-input type="text" name="descripcion" label="Descripcion"
                                        label-class="text-lightblue" value="{{ $categoria->descripcion }}">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fas fa-solid fa-file-signature text-lightblue"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                </div>
                                <div class="col-md-6">
                                    <x-adminlte-select name="estado" label="ESTADO" label-class="text-lightblue"
                                        igroup-size="lg">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-gradient-info">
                                                <i class="fas fa-regular fa-eye-slash"></i>
                                            </div>

                                        </x-slot>

                                        <option value="{{ $categoria->id }}">{{ $categoria->estado }}</option>
                                        <option value="Inactiva">Inactiva</option>
                                        <option value="Activa">Activa</option>
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
    <x-adminlte-modal id="modalCrear" title="Creando categoria" theme="primary" icon="fas fa-solid fa-plus" size='lg'
        disable-animations class="center">
        <form action="{{ route('categoria.store') }}" method="POST">
            @csrf

            <div class="col-md-6">
                <!-- NOMBRE -->
                <x-adminlte-input type="text" name="nombre" label="NOMBRE" placeholder="INGRESA EL NOMBRE"
                    label-class="text-lightblue" value="{{ old('nombre') }}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-solid fa-file-signature text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </div>
            <div class="col-md-12">
                <!-- DESCRIPCION -->
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

            <x-adminlte-button class="btn-flat" type="submit" label="Guardar" theme="primary" icon="fas fa-lg fa-save" />
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
