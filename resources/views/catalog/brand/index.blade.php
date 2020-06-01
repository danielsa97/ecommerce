@extends('adminlte::page')

@section('content_header')
    <h1>Marcas</h1>
@stop

@section('content')
    <b-row>
        <b-col cols="12" class="text-right">
            <b-form-group>
                <b-button variant="primary">Cadastrar</b-button>
            </b-form-group>
        </b-col>
        <b-col>
            <b-card class="table-responsive">
                {!! $brandDataTable->table()!!}
            </b-card>
        </b-col>
    </b-row>
@stop

@section('js')
    {{ $brandDataTable->scripts()}}
@stop
