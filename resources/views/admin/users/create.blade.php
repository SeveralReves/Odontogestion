@extends('adminlte::page')

@section('title', 'odontogestion')

@section('content_header')
    <a type="button" href="/users" class="btn btn-link"> Regresar </a>
    <h1 class="m-0 text-dark">Crear Usuario </h1>
    @stop

    @section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach

            </ul>
        </div>
    @endif
   {{-- @dd(session()->all()) --}} 
   <form action="{{route ('store-users')}}" method="post">
    @csrf
    <div class="row">
        <x-adminlte-input name="name" label="Nombres" placeholder="Ingresa el nombre del Usuario"
        fgroup-class="col-md-6" label-class="text-primary">
    </x-adminlte-input>
    <x-adminlte-input name="password" label="Contraseña" placeholder="Ingresa la contraseña"
        fgroup-class="col-md-6" label-class="text-primary">
    </x-adminlte-input>
    <x-adminlte-input name="email" label="Correo electrónico" placeholder="mail@mail.com" fgroup-class="col-md-6"
        label-class="text-primary">
    </x-adminlte-input>
    {{--el role deberia ir dentro de un switch?--}}
    <x-adminlte-input name="role" label="Rol" placeholder="Ingresa El Rol del usuario"
        fgroup-class="col-md-6" label-class="text-primary">
    </x-adminlte-input>
</div>
<div class="row">
    <div class="form-group col-md-6">
        <x-adminlte-button class="btn-flat" type="submit" label="Submit" theme="primary"
            icon="fas fa-lg fa-save" />
    </div>
</div>
</form> 
@stop