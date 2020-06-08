@extends('adminlte::page')

@section('content_header')
    <h1>Departamentos</h1>
@stop

@section('content')
    <b-card class="table-responsive">
        {!! $departmentDataTable->table()!!}
    </b-card>
    <department-manager datatable="department_datatable"></department-manager>
@stop

@section('js')
    {{ $departmentDataTable->scripts()}}
    <script>
        window.btnCadastroDataTable('{{$departmentDataTable->getTableAttribute('id')}}');
    </script>
@stop
