@extends('adminlte::page')

@section('content_header')
    <h1>Marcas</h1>
@stop

@section('content')
    <b-card class="table-responsive">
        {!! $brandDataTable->table()!!}
    </b-card>
    <brand-manager datatable="brand_datatable"></brand-manager>
@stop

@section('js')
    {{ $brandDataTable->scripts()}}
@stop
