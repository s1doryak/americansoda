@extends('material-admin::minimal')

@section('content')
    <!-- Login -->
    <div class="lc-block" id="l-login">

        @if(config('app.logo'))
            <div class="logo">
                <img src="{{ asset(config('app.logo')) }}?ver={{ config('app.version') }}" alt="{{ config('app.name') }}">
            </div>
        @endif

        <div class="lcb-form">

            <form class="form-horizontal" role="form" method="POST" action="{{ route(prefix_name() . '.login') }}">
                @csrf

                <div class="input-group m-b-20">
                    <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                    <div class="fg-line{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="text" name="email" class="form-control" placeholder="{{ trans('material-admin::auth.login.email') }}" value="{{ old('email') }}" autocomplete="off">
                    </div>
                    @if ($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="input-group m-b-20">
                    <span class="input-group-addon"><i class="zmdi zmdi-key"></i></span>
                    <div class="fg-line{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" name="password" class="form-control" placeholder="{{ trans('material-admin::auth.login.password') }}" autocomplete="off">
                    </div>
                    @if ($errors->has('password'))
                        <span class="help-block">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="clearfix"></div>

                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" value="on">
                        <i class="input-helper"></i>
                        {{ trans('material-admin::auth.login.remember') }}
                    </label>
                </div>

                <button type="submit" class="btn btn-login btn-danger btn-float">
                    <i class="zmdi zmdi-arrow-forward"></i></button>

            </form>
        </div>

        <div class="lcb-navigation">
            @if(has_route(prefix_name() . '.register'))
                <a href="{{ route(prefix_name() . '.register') }}">
                    <i class="zmdi zmdi-plus"></i> <span>{{ trans('material-admin::auth.buttons.register') }}</span>
                </a>
            @endif
            @if(has_route(prefix_name() . '.password.request'))
                <a href="{{ route(prefix_name() . '.password.request') }}">
                    <i class="zmdi zmdi-key"></i> <span>{{ trans('material-admin::auth.buttons.forgot_password') }}</span>
                </a>
            @endif
        </div>
    </div>
@endsection
