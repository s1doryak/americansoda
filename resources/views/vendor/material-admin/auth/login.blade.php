@extends('material-admin::auth')

@section('content')
    <!-- Login -->
    <div class="lc-block" id="l-login">

        @if(config('app.logo'))
            <div class="logo">
                <img src="{{ asset(config('app.logo')) }}?ver={{ config('app.version') }}" alt="{{ config('app.name') }}">
            </div>
        @endif

        <div class="lcb-form">

            <form class="form-horizontal" role="form" method="POST" action="{{ route(sprintf('%s.login', prefix_name())) }}">

                {!! csrf_field() !!}

                @if(is_demo())
                    <div class="form-group m-b-0 m-l-0">
                        <div class="fg-line{{ $errors->has('email') ? ' has-error' : '' }}">
                            {!! Form::select('email', get_auth_list(prefix_name())->pluck('name', 'email'), null, ['class' => 'form-control selectpicker'], get_auth_list(prefix_name())->mapWithKeys(function (\Crmplease\MaterialAdmin\Foundation\Auth\User $authenticatable) {
                                return [
                                    $authenticatable->getEmailForPasswordReset() => [
                                        'data-content' => $authenticatable->content
                                    ]
                                ];
                            })->toArray()) !!}
                        </div>
                        @if ($errors->has('email'))
                            <span class="help-block">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <input type="hidden" name="password" value="secret">
                @else
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
                @endif

                <button type="submit" class="btn btn-login btn-danger btn-float"><i class="zmdi zmdi-arrow-forward"></i></button>

            </form>
        </div>

        @if(!is_demo())
            <div class="lcb-navigation">
                @if(has_route(sprintf('%s.register', prefix_name())))
                <a href="{{ route(sprintf('%s.register', prefix_name())) }}" data-ma-no-action="login-switch" data-ma-block="#l-register"><i class="zmdi zmdi-plus"></i> <span>{{ trans('material-admin::auth.buttons.register') }}</span></a>
                @endif
                <a href="{{ route(sprintf('%s.password.request', prefix_name())) }}" data-ma-no-action="login-switch" data-ma-block="#l-forget-password"><i>?</i> <span>{{ trans('material-admin::auth.buttons.forgot_password') }}</span></a>
            </div>
        @endif
    </div>
@endsection
