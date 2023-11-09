@extends('adminlte::page')

@section('title', 'Unidad Medida')

@section('content_header')


@stop

@section('content')
    <div class="card">

        <div class="class-header d-flex justify-content-between">
            <h2 class="m-2">Unidades de Medidas</h2>
            @can('Crear')
                <x-adminlte-button label="Nueva" theme="primary" icon="fas fa-solid fa-plus" class="m-3" data-toggle="modal"
                    data-target="#modalCrear" />
            @endcan


        </div>
        <hr>
        <div class="card-body">
            @php
                $heads = ['ID', 'NOMBRE', 'ABREVIATURA', 'CONVERSION', 'ESTADO', ['label' => 'Actions', 'no-export' => true, 'width' => 15]];

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
                @foreach ($unidad_de_medidas as $unidad_de_medida)
                    <tr>
                        <td>{{ $unidad_de_medida->id }}</td>
                        <td>{{ $unidad_de_medida->nombre }}</td>
                        <td>{{ $unidad_de_medida->abreviatura }}</td>
                        <td>{{ $unidad_de_medida->conversion }}</td>
                        <td>{{ $unidad_de_medida->estado }}</td>
                        <td>
                            @can('Actualizar')
                                <a class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit" data-toggle="modal"
                                    data-target="#modalActualizar{{ $unidad_de_medida->id }}">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </a>
                            @endcan
                            @can('Eliminar')
                                <form style="display: inline;"
                                    action="{{ route('unidad_de_medida.destroy', $unidad_de_medida) }}" method="POST"
                                    class="formEliminar">
                                    @csrf
                                    @method('delete')
                                    {!! $btnDelete !!}
                                </form>
                            @endcan

                        </td>
                    </tr>

                    {{-- Themed --}}
                    <x-adminlte-modal id="modalActualizar{{ $unidad_de_medida->id }}" title="Editando Unidad De Medida"
                        theme="primary" icon="fas fa-solid fa-edit" size='lg' disable-animations class="center">
                        <form action="{{ route('unidad_de_medida.update', $unidad_de_medida) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- NOMBRE -->
                                    <x-adminlte-input type="text" name="nombre" label="NOMBRE"
                                        label-class="text-lightblue" value="{{ $unidad_de_medida->nombre }}">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fas fa-solid fa-file-signature text-lightblue"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                </div>

                                <div class="col-md-6">
                                    <!-- DESCRIPCION -->
                                    <x-adminlte-input type="text" name="abreviatura" label="ABREVIATURA"
                                        label-class="text-lightblue" value="{{ $unidad_de_medida->abreviatura }}">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fas fa-solid fa-file-signature text-lightblue"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                </div>

                                <div class="col-md-6">
                                    <!-- DESCRIPCION -->
                                    <x-adminlte-input type="text" name="conversion" label="CONVERSION"
                                        label-class="text-lightblue" value="{{ $unidad_de_medida->conversion }}">
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

                                        <option value="{{ $unidad_de_medida->id }}">{{ $unidad_de_medida->estado }}
                                        </option>
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
    <x-adminlte-modal id="modalCrear" title="Creando unidad de medida" theme="primary" icon="fas fa-solid fa-plus"
        size='lg' disable-animations class="center">
        <form action="{{ route('unidad_de_medida.store') }}" method="POST">
            @csrf
<div class="row">
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
            <div class="col-md-6">
                <!-- DESCRIPCION -->
                <x-adminlte-input type="text" name="abreviatura" label="ABREVIATURA"
                    placeholder="INGRESA LA ABREVIATURA" label-class="text-lightblue"
                    value="{{ old('abreviatura') }}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-solid fa-file-signature text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </div>

            <div class="col-md-6 text-lightblue">

                {{-- With append slot, number type and sm size --}}
                <x-adminlte-input name="conversion" label="CONVERSION"  type="numeric"
                    igroup-size="sm"  value="{{old('conversion')}}">
                    <x-slot name="appendSlot">
                        <div class="input-group-text bg-lightblue">
                            <i class="fas fa-hashtag"></i>
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
