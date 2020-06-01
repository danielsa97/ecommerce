@extends('adminlte::page')

@section('content_header')
    <h1>Usuários</h1>
@stop

@section('content')
    <b-row>
        <b-col cols="12" class="text-right">
            <b-form-group>
                <b-button variant="primary" v-b-modal.user_form>Cadastrar</b-button>
            </b-form-group>
        </b-col>
        <b-col>
            <b-card class="table-responsive">
                {!! $userDataTable->table(['id'=>'user_datatable'])!!}
            </b-card>
        </b-col>
    </b-row>
    <user-form datatable-id="user_datatable"></user-form>
@stop

@section('js')
    {{ $userDataTable->scripts()}}
@stop
