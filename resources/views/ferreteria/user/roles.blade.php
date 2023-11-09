@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>CREAR ROLES</h1>
@stop

@section('content')
    <div class="card">
        <div class="class-header">
            <x-adminlte-button label="Nuevo" theme="primary" icon="fas fa-solid fa-paw" class="float-right m-3"
                data-toggle="modal" data-target="#modalPurple" />
        </div>
        <hr>
        <div class="card-body">
            @php
                $heads = ['ID', 'NOMBRE', ['label' => 'Actions', 'no-export' => true, 'width' => 15]];

                $btnDelete = '<button  type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                    <i class="fa fa-lg fa-fw fa-trash"></i>
                </button>';
                $config = [
                    'language' => [
                        'url' => '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                    ],
                ];
            @endphp

            <x-adminlte-datatable id="table5" :config="$config" :heads="$heads" theme="light" striped hoverable>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            <a href="{{ route('roles.edit', $role) }}"
                                class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
                            <form style="display: inline;" action="{{ route('roles.destroy', $role) }}" method="POST"
                                class="formEliminar">
                                @csrf
                                @method('delete')
                                {!! $btnDelete !!}
                            </form>
                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
        </div>
    </div>

    {{-- Themed --}}
    <x-adminlte-modal id="modalPurple" title="Creando Rol" theme="primary" icon="fas fa-solid fa-paw" size='lg'
        disable-animations class="center">
        <form action="{{ route('roles.store') }}" method="POST">
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
                    showConfirmButton: false,
                    timer: 3000
                })
            });
        </script>
    @endif
@stop
