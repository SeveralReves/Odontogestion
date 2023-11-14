@extends('adminlte::page')

@section('title', 'OdontoGestion')

@section('content_header')
    <a type="button" href="/appointment_types" class="btn btn-link"> Regresar</a>
    <h1 class="m-0 text-dark">Crear Tipo de Cita</h1>
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
<form action="{{ route('store-appointment_type') }}" method="post">
        @csrf
        <div class="row">
            <x-adminlte-input name="name" label="Nombres" placeholder="Ingresa el nombre del Cliente "
                fgroup-class="col-md-6" label-class="text-primary">
            </x-adminlte-input>
            <x-adminlte-input name="type" label="Tipo" placeholder="Ingresa El tipo de cita"
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