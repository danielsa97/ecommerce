@extends('adminlte::page')

@section('content_header')
    <h1>Departamentos</h1>
@stop

@section('content')
    <b-row>
        <b-col cols="12" class="text-right">
            <b-form-group>
                <b-button variant="primary" v-b-modal.department_modal>Cadastrar</b-button>
            </b-form-group>
        </b-col>
        <b-col>
            <b-card class="table-responsive">
                {!! $departmentDataTable->table()!!}
            </b-card>
        </b-col>
    </b-row>
    <department-manager datatable="department_datatable"></department-manager>
@stop

@section('js')
    {{ $departmentDataTable->scripts()}}
@stop
