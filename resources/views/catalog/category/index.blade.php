@extends('adminlte::page')

@section('content_header')
    <h1>Categorias</h1>
@stop

@section('content')
    <b-card class="table-responsive">
        {!! $categoryDataTable->table()!!}
    </b-card>
    <category-manager datatable="category_datatable"></category-manager>
@stop

@section('js')
    {{ $categoryDataTable->scripts()}}
@stop
