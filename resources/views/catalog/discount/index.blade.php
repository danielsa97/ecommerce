@extends('adminlte::page')

@section('content_header')
    <h1>Descontos</h1>
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
                {!! $discountDataTable->table()!!}
            </b-card>
        </b-col>
    </b-row>
    <discount-manager datatable="department_datatable"></discount-manager>
@stop

@section('js')
    {{ $discountDataTable->scripts()}}
    <script>
        window.btnCadastroDataTable('{{$discountDataTable->getTableAttribute('id')}}');
    </script>
@stop
