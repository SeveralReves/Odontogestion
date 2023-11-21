@extends('adminlte::page')

@section('title', 'OdontoGestion')

@section('content_header')
    <a type="button" href="/clients" class="btn btn-light"><i class="fas fa-arrow-left"></i> Regresar</a>
    <h1 class="m-0 mt-2 text-dark">Editar Cliente {{ $client->id }}</h1>
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
    <form action="{{ route('clients.update', $client->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <x-adminlte-input name="name" label="Nombres" value="{{ old('name', $client->name) }}"
                placeholder="Ingresa los nombres del cliente" fgroup-class="col-md-6" label-class="text-primary">
            </x-adminlte-input>
            <x-adminlte-input name="lastname" label="Apellidos" value="{{ old('lastname', $client->lastname) }}"
                placeholder="Ingresa los apellidos del cliente" fgroup-class="col-md-6" label-class="text-primary">
            </x-adminlte-input>
            <x-adminlte-input name="id_number" label="Cédula de identidad" value="{{ old('id_number', $client->id_number) }}"
                placeholder="XX.XXX.XXX" fgroup-class="col-md-6" label-class="text-primary">
                <x-slot name="bottomSlot">
                    <span class="text-sm text-gray">
                        Solo ingresa los numeros
                    </span>
                </x-slot>
            </x-adminlte-input>
            <x-adminlte-input name="email" label="Correo electrónico" value="{{ old('email', $client->email) }}"
                placeholder="mail@mail.com" fgroup-class="col-md-6" label-class="text-primary">
            </x-adminlte-input>
            <x-adminlte-input name="phone" label="Teléfono" value="{{ old('phone', $client->phone) }}"
                placeholder="04121231212" fgroup-class="col-md-6" label-class="text-primary">
                <x-slot name="bottomSlot">
                    <span class="text-sm text-gray">
                        Solo ingresa los numeros
                    </span>
                </x-slot>
            </x-adminlte-input>
            @php
                $config = ['format' => 'DD/MM/YYYY', 'maxDate' => 'js:moment()'];
            @endphp
            <x-adminlte-input-date name="birthday" :config="$config" label="Fecha de nacimiento"
                value="{{ old('birthday', $client->birthday) }}" placeholder="Escoge una fecha..." fgroup-class="col-md-6"
                label-class="text-primary">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-clock"></i>
                    </div>
                </x-slot>
            </x-adminlte-input-date>
            <x-adminlte-textarea name="address" label="Dirección" value="{{old('address', $client->address)}}"
                placeholder="Ingresa dirección..." label-class="text-primary" fgroup-class="col-md-6" />
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <x-adminlte-button class="btn-flat" type="submit" label="Actualizar" theme="primary"
                    icon="fas fa-lg fa-save" />
            </div>
        </div>
    </form>
@stop
