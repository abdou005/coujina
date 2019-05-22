@extends('dashboard.layouts.app')
@section('title')
    {{__('messages.login')}}
@endsection
@section('body_class','hold-transition login-page')
@section('content')
    <div class="login-box">
        {{--<div class="login-logo">--}}
            {{--<a href=""><b>C</b>ook</a>--}}
        {{--</div>--}}
        <div class="login-logo" data-wow-duration="1000ms" data-wow-delay="500ms">
            <h1><a href="{{url('/')}}" style="color: white;"><span>C</span><img src="/web/images/oo.png" alt=""><img src="/web/images/oo.png" alt="">ujina</a></h1>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body" style="border: 5px solid #005238;">
            <p class="login-box-msg">@lang('messages.subject_connect')</p>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" name="email" class="form-control" placeholder="@lang('messages.email')" value="{{ old('email') }}" required autofocus >
                    <span class="fa fa-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }} ">
                    <input type="password" class="form-control" placeholder="@lang('messages.password')" name="password" required>
                    <span class="fa fa-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input  type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> @lang('messages.remember')
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-danger btn-block btn-flat btn-cook">@lang('messages.validate')</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <div class="row">
                <div class="col-xs-8">
                    <a class="btn btn-link" style="color: #005238; font-weight: bold;" href="{{ route('password.request') }}">@lang('messages.message_forgetPassword_app')</a><br>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <a class="btn btn-link" style="color: #005238; font-weight: bold;"  href="{{ route('register') }}" class="text-center">@lang('messages.subject_register')</a>
                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- /.login-box-body -->
    </div>
@endsection
@section('styles')
    <!-- iCheck -->
    <link href="{{asset('plugins/iCheck/green.css')}}" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            align-items: center;
            justify-content: center;
            display: flex;
        }
    </style>
@endsection

@section('scripts')
    <!-- iCheck -->
    <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
                increaseArea: '20%' // optional
            });
        });
    </script>
@endsection