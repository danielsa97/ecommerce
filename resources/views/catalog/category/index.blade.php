@extends('adminlte::page')

@section('content_header')
    <h1>Categorias</h1>
@stop

@section('content')
    <b-row>
        <b-col cols="12" class="text-right">
            <b-form-group>
                <b-button variant="primary" v-b-modal.category_modal>Cadastrar</b-button>
            </b-form-group>
        </b-col>
        <b-col>
            <b-card class="table-responsive">
                {!! $categoryDataTable->table()!!}
            </b-card>
        </b-col>
    </b-row>
    <category-manager datatable="category_datatable"></category-manager>
@stop

@section('js')
    {{ $categoryDataTable->scripts()}}
@stop
