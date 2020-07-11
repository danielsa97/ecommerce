@extends('adminlte::master')
@section('body')
    <div class="login-page">
        <div class="login-box ">
            <div class="login-logo">
                @if(session('brand'))
                    <img class="img-fluid pl-5 pr-5 pb-2" src="{{route('image.index', session('brand'))}}" alt="{!! config('adminlte.title', '<b>E</b>-Commerce') !!}">
                @else {!! config('adminlte.title', '<b>E</b>-Commerce') !!} @endif
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">{{ __('adminlte::adminlte.login_message') }}</p>
                    <form action="{{ config('adminlte.login_url', 'login') }}" method="post">
                        {{ csrf_field() }}
                        <div class="input-group mb-3">
                            <input type="email" name="email"
                                   class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                   value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}"
                                   autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password"
                                   class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                   placeholder="{{ __('adminlte::adminlte.password') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" name="remember" id="remember">
                                    <label for="remember">{{ __('adminlte::adminlte.remember_me') }}</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">
                                    {{ __('adminlte::adminlte.sign_in') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
