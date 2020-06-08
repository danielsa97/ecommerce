@extends('adminlte::page')

@section('content_header')
    <h1>Marcas</h1>
@stop

@section('content')
    <b-row>
        <b-col cols="12" class="text-right">
            <b-form-group>
                <b-button variant="primary" v-b-modal.brand_modal>Cadastrar</b-button>
            </b-form-group>
        </b-col>
        <b-col>
            <b-card class="table-responsive">
                {!! $brandDataTable->table()!!}
            </b-card>
        </b-col>
    </b-row>
    <brand-manager datatable="brand_datatable"></brand-manager>
@stop

@section('js')
    {{ $brandDataTable->scripts()}}
@stop
