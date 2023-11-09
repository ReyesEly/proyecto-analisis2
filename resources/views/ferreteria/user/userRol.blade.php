@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <h1>USUARIOS Y ROLES</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header">
           <b><p>{{ $user->name }}</p></b> 
           
        </div>
        <div class="card-body">
            <h5>LISTA DE PERMISOS</h5>
            {!! Form::model($user, ['route' => ['asignar.update', $user], 'method' => 'put']) !!}
            @foreach ($roles as $role)

                <div>
                    <label>
                        {!! Form::checkbox('roles[]', $role->id, $user->hasAnyRole($role->id) ? : false, ['class' => 'mr-1 ']) !!}
                    {{$role->name}}
                    </label>
                </div>
            @endforeach
           
            {!! Form::submit('Asignar Roles', ['class' => 'btn btn-primary']) !!}

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
@stop
