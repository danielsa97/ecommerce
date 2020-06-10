@extends('adminlte::page')

@section('content_header')
    <h1>Usuários</h1>
@stop

@section('content')
    <b-card class="table-responsive">
        {!! $userDataTable->table()!!}
    </b-card>
    <user-manager datatable="user_datatable"></user-manager>
@stop

@section('js')
    {{ $userDataTable->scripts()}}
@stop
