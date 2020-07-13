@extends('adminlte::page')
@section('content')
    <page>
        <transition name="slide-fade" mode="out-in">
            <router-view></router-view>
        </transition>
    </page>
@stop
