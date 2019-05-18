@extends('material-admin::.auth')

@section('content')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <!-- Forgot Password -->
    <div class="lc-block" id="l-forget-password">

        @if(config('app.logo'))
            <div class="logo">
                <img src="{{ asset(config('app.logo')) }}?ver={{ config('app.version') }}" alt="{{ config('app.name') }}">
            </div>
        @endif

        <div class="lcb-form">

            <form class="form-horizontal" role="form" method="POST" action="{{ route(sprintf('%s.password.request', prefix_name())) }}">

                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="input-group m-b-20">
                    <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
                    <div class="fg-line{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="text" name="email" class="form-control" placeholder="{{ trans('material-admin::auth.reset_password.email') }}" value="{{ $email or old('email') }}">
                    </div>
                    @if ($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="input-group m-b-20">
                    <span class="input-group-addon"><i class="zmdi zmdi-key"></i></span>
                    <div class="fg-line{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" name="password" class="form-control" placeholder="{{ trans('material-admin::auth.register.password') }}">
                    </div>
                    @if ($errors->has('password'))
                        <span class="help-block">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="input-group m-b-10">
                    <span class="input-group-addon"><i class="zmdi zmdi-key"></i></span>
                    <div class="fg-line{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="{{ trans('material-admin::auth.register.password_confirmation') }}">
                    </div>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>

                <div class="clearfix"></div>

                <button type="submit" class="btn btn-login btn-success btn-float"><i class="zmdi zmdi-check"></i></button>

            </form>
        </div>

        <div class="lcb-navigation">
            <a href="{{ route(sprintf('%s.login', prefix_name())) }}" data-ma-no-action="login-switch" data-ma-block="#l-login"><i class="zmdi zmdi-long-arrow-right"></i> <span>{{ trans('material-admin::auth.buttons.login') }}</span></a>
            @if(has_route(sprintf('%s.register', prefix_name())))
            <a href="{{ route(sprintf('%s.register', prefix_name())) }}" data-ma-no-action="login-switch" data-ma-block="#l-register"><i class="zmdi zmdi-plus"></i> <span>{{ trans('material-admin::auth.buttons.register') }}</span></a>
            @endif
        </div>
    </div>
@endsection
