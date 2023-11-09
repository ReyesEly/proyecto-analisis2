@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Administrar Usuarios</h1>
@stop

@section('content')

    <div class="card ">

        
        
        <div class="card-body">


            {{-- Setup data for datatables --}}

            @php
                $heads = ['ID', 'NOMBRE', 'CORREO', ['label' => 'Acciones', 'no-export' => true, 'width' => 15]];

                $btnDelete = '<button  type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
              </button>';
                $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                   <i class="fa fa-lg fa-fw fa-eye"></i>
               </button>';

                $config = [
                    'language' => [
                        'url' => '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                    ],
                ];
            @endphp

            {{-- Minimal example / fill data using the component slot --}}
            <x-adminlte-datatable id="table5" :heads="$heads" :config="$config" theme="light" striped hoverable>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email}}</td>


                        <td>
                            <a href="{{ route('asignar.edit', $user) }}"
                                class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
                            <form style="display: inline;" action="{{ route('asignar.destroy', $user) }}" method="POST"
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
   
  

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
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
@stop
