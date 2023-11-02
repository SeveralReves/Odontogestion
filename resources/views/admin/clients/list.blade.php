@extends('adminlte::page')

@section('title', 'OdontoGestion')

@section('content_header')
    <h1 class="m-0 text-dark">Clientes</h1>
@stop

@section('content')
    @if (isset($success) && !empty($success))
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success" role="alert">
                    {{ $success }}
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <a href="clients/create" class="btn btn-primary">Crear Nuevo</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <x-adminlte-datatable id="table1" :heads="$heads">
                        @foreach ($clients as $row)
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->lastname }}</td>
                                <td>{{ $row->phone }}</td>
                                <td>{{ $row->birthday }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->id_number }}</td>
                            </tr>
                        @endforeach
                    </x-adminlte-datatable>
                </div>
            </div>
        </div>
    </div>
@stop
