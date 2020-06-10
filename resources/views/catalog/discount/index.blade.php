@extends('adminlte::page')

@section('content_header')
    <h1>Descontos</h1>
@stop

@section('content')
    <b-card class="table-responsive">
        {!! $discountDataTable->table()!!}
    </b-card>
    <discount-manager datatable="discount_datatable"></discount-manager>
@stop

@section('js')
    {{ $discountDataTable->scripts()}}
@stop
