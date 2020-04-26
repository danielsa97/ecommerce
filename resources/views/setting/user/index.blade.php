@extends('adminlte::page')

@section('content_header')
    <h1>Usuários</h1>
@stop

@section('content')
    <b-row>
        <b-col>
            <b-card class="table-responsive">
                {!! $dataTable->table(['class' => 'table'])!!}
            </b-card>
        </b-col>
    </b-row>
@stop

@section('js')
    {{ $dataTable->scripts() }}
@stop
