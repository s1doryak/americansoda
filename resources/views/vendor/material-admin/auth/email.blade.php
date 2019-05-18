@extends('material-admin::auth')

@section('content')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <!-- Setup Email -->
    <div class="lc-block" id="l-forget-password">

        @if(config('app.logo'))
            <div class="logo">
                <img src="{{ asset(config('app.logo')) }}?ver={{ config('app.version') }}" alt="{{ config('app.name') }}">
            </div>
        @endif

        <div class="lcb-form">

            <form class="form-horizontal" role="form" method="POST" action="{{ route(sprintf('%s.register.email', prefix_name())) }}">

                {{ csrf_field() }}

                @if($provider && $user)
                    {!! Form::hidden('provider', $provider) !!}
                    {!! Form::hidden('provider_id', $user->getId()) !!}
                    {!! Form::hidden('name', $user->getName()) !!}
                    {!! Form::hidden('photo', $user->getAvatar()) !!}
                    <div class="input-group">
                        <div class="media">
                            @if($user->getAvatar())
                                <div class="pull-left">
                                    <img src="{{ $user->getAvatar() }}" alt="{{ $user->getName() }}" class="lgi-img">
                                </div>
                            @endif
                            <div class="media-body text-left">
                                <div class="lgi-heading">
                                    {{ $user->getName() }}
                                </div>
                                <div class="lgi-text">
                                    <div class="fg-line{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <input type="text" name="email" class="form-control" placeholder="{{ trans('material-admin::auth.login.email') }}" value="{{ old('email') }}">
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="help-block">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <button type="submit" class="btn btn-login btn-success btn-float"><i class="zmdi zmdi-check"></i></button>

            </form>
        </div>

    </div>
@endsection
