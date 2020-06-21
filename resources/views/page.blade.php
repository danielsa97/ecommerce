@extends('adminlte::page')
@section('content')
    <transition>
        <router-view class="view"></router-view>
    </transition>
@stop
