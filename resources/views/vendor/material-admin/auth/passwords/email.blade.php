@extends('material-admin::minimal')

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

            <form class="form-horizontal" role="form" method="POST" action="{{ route(sprintf('%s.password.email', prefix_name())) }}">
                @csrf

                <div class="input-group m-b-10">
                    <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
                    <div class="fg-line{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="text" name="email" class="form-control" placeholder="{{ trans('material-admin::auth.reset_password.email') }}" value="{{ old('email') }}">
                    </div>
                    @if ($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <button type="submit" class="btn btn-login btn-success btn-float">
                    <i class="zmdi zmdi-check"></i>
                </button>

            </form>
        </div>

        <div class="lcb-navigation">
            @if(has_route(prefix_name() . '.login'))
                <a href="{{ route(prefix_name() . '.login') }}">
                    <i class="zmdi zmdi-long-arrow-right"></i> <span>{{ trans('material-admin::auth.buttons.login') }}</span>
                </a>
            @endif
            @if(has_route(prefix_name() . '.register'))
                <a href="{{ route(prefix_name() . '.register') }}">
                    <i class="zmdi zmdi-plus"></i> <span>{{ trans('material-admin::auth.buttons.register') }}</span>
                </a>
            @endif
        </div>
    </div>
@endsection
