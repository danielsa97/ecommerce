@extends('adminlte::page')

@section('content_header')
    <h1>Usuários</h1>
@stop

@section('content')
    <b-row>
        <b-col cols="12" class="text-right">
            <b-form-group>
                <b-button variant="primary" v-b-modal.user_modal>Cadastrar</b-button>
            </b-form-group>
        </b-col>
        <b-col>
            <b-card class="table-responsive">
                {!! $userDataTable->table()!!}
            </b-card>
        </b-col>
    </b-row>
    <user-manager datatable="user_datatable"></user-manager>
@stop

@section('js')
    {{ $userDataTable->scripts()}}
@stop
