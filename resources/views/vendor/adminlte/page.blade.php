@extends('adminlte::master')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('body_data',
(config('adminlte.sidebar_scrollbar_theme', 'os-theme-light') != 'os-theme-light' ? 'data-scrollbar-theme=' . config('adminlte.sidebar_scrollbar_theme')  : '') . ' ' . (config('adminlte.sidebar_scrollbar_auto_hide', 'l') != 'l' ? 'data-scrollbar-auto-hide=' . config('adminlte.sidebar_scrollbar_auto_hide')   : ''))

@php( $logout_url = View::getSection('logout_url') ?? config('adminlte.logout_url', 'logout') )
@php( $profile_url = View::getSection('profile_url') ?? config('adminlte.profile_url', 'logout') )
@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
    @php( $logout_url = $logout_url ? route($logout_url) : '' )
    @php( $profile_url = $profile_url ? route($profile_url) : '' )
    @php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
    @php( $logout_url = $logout_url ? url($logout_url) : '' )
    @php( $profile_url = $profile_url ? url($profile_url) : '' )
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

@section('body')
    <div class="wrapper" id="app">
        <nav
            class="main-header navbar {{config('adminlte.classes_topnav_nav', 'navbar-expand-md')}} {{config('adminlte.classes_topnav', 'navbar-white navbar-light')}}">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"
                       @if(config('adminlte.sidebar_collapse_remember')) data-enable-remember="true"
                       @endif @if(!config('adminlte.sidebar_collapse_remember_no_transition')) data-no-transition-after-reload="false"
                       @endif @if(config('adminlte.sidebar_collapse_auto_size')) data-auto-collapse-size="{{config('adminlte.sidebar_collapse_auto_size')}}" @endif>
                        <i class="fas fa-bars"></i>
                        <span class="sr-only">{{ __('adminlte::adminlte.toggle_navigation') }}</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto @if(config('adminlte.layout_topnav') || View::getSection('layout_topnav'))order-1 order-md-3 navbar-no-expand @endif">
                @if(Auth::user())
                    <li class="nav-item">
                        <a class="nav-link" href="#"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-fw fa-power-off"></i> {{ __('adminlte::adminlte.log_out') }}
                        </a>
                        <form id="logout-form" action="{{ $logout_url }}" method="POST"
                              style="display: none;">
                            @if(config('adminlte.logout_method'))
                                {{ method_field(config('adminlte.logout_method')) }}
                            @endif
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endif
            </ul>
        </nav>
        <aside class="main-sidebar vh-100 {{config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4')}}">
            <a href="{{ $dashboard_url }}"
               class="brand-link bg-light text-center {{ config('adminlte.classes_brand') }}">
                @if(session('brand'))
                    <img class="img-fluid pl-5 pr-5 pb-2" src="{{route('image.index', session('brand'))}}"
                         alt="{!! config('adminlte.title', '<b>E</b>-Commerce') !!}">
                @else
                    <span class="brand-text  font-weight-light {{ config('adminlte.classes_brand_text') }}">
                        {!! config('adminlte.logo', '<b>E-</b>commerce') !!}
                    </span>
                @endif

            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <sidebar></sidebar>
                </nav>
            </div>
        </aside>
        @yield('content')
        @hasSection('footer')
            <footer class="main-footer">
                @yield('footer')
            </footer>
        @endif

    </div>
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
