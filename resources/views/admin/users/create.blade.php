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
   <form action="{{ route('store-users') }}" method="post">
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
            <x-adminlte-select2 
                name="role"  
                label="Tipo de usuario"
                label-class="text-lightblue"
                data-placeholder="Seleccione un tipo de usuario..." 
                value="{{ old('role') }}" 
                fgroup-class="col-md-6" 
                label-class="text-primary"
            >
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-tags"></i>
                    </div>
                </x-slot>
                <option {{old('role') ? '' : 'selected'}} disabled>Seleccione un Rol de usuario</option>
                
                @foreach (['Asistente', 'Dentista', 'Administrador', 'Paciente'] as $key => $value)
                    <option value="{{ $value }}" {{ old('role') == $value ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </x-adminlte-select2>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <x-adminlte-button class="btn-flat" type="submit" label="Guardar" theme="primary"
                    icon="fas fa-lg fa-save" />
            </div>
        </div>
    </form>
@stop
