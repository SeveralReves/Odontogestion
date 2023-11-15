@extends('adminlte::page')

@section('title', 'odontogestion')

@section('content_header')
    <a type="button" href="/users" class="btn btn-light"><i class="fas fa-arrow-left"></i> Regresar </a>
    <h1 class="m-0 text-dark">Editar Usuario {{$users->id}}</h1>
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
   <form action="{{route ('users.update', $users->id)}}" method="post">
    @csrf
    @method('PUT')
    <div class="row">
        <x-adminlte-input name="name" label="Nombres" value="{{ old('name', $users->name) }}"
        placeholder="Ingresa el nombre del Usuario"
        fgroup-class="col-md-6" label-class="text-primary">
    </x-adminlte-input>
    <x-adminlte-input name="password" label="Contraseña" value="{{ old('password', $users->password) }}"
     placeholder="Ingresa la contraseña"
        fgroup-class="col-md-6" label-class="text-primary">
    </x-adminlte-input>
    <x-adminlte-input name="email" label="Correo electrónico" value="{{ old('email', $client->email) }}"
     placeholder="mail@mail.com" fgroup-class="col-md-6"
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
    <option <x-adminlte-select2 
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
            </x-adminlte-select2> disabled>Seleccione un Rol de usuario</option>
    
    @foreach (['Asistente', 'Dentista', 'Administrador', 'Paciente'] as $key => $value)
        <option value="{{ old('password', $users->password) }}">{{ $value }}</option>
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