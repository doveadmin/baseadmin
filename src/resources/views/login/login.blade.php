@extends('dacore.baseadmin::layout.base')
@section('title', '登录')

@section('content')
    <div class="signinpanel">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{route('login.auth')}}" method="post">
                    {{--主标题--}}
                    @if(config('dacore_baseadmin.baseadmin_login_title'))
                        <h4 class="no-margins">{{config('dacore_baseadmin.baseadmin_login_title')}}</h4>
                        {{--副标题--}}
                        @if(config('dacore_baseadmin.baseadmin_login_second_title'))
                            <p class="m-t-md">{{config('dacore_baseadmin.baseadmin_login_second_title')}}</p>
                        @endif
                    @else
                        <h4 class="no-margins">登录：</h4>
                        <p class="m-t-md">登录到{{config('dacore_baseadmin.baseadmin_name')}}</p>
                    @endif
                    <input type="text" class="form-control uname" placeholder="用户名" name="username"  />
                    <input type="password" class="form-control pword m-b" placeholder="密码" name="password"  />

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button class="btn btn-success btn-block">登录</button>
                    {{ csrf_field() }}
                </form>
            </div>
        </div>

        {{--底部配置--}}
        @if(config('dacore_baseadmin.baseadmin_login_footer'))
            <div class="signup-footer">
                <div class="pull-left">
                    {{config('dacore_baseadmin.baseadmin_login_footer')}}
                </div>
            </div>
        @else
            {{--<div class="signup-footer">--}}
            {{--<div class="pull-left">--}}
            {{--&copy; DACore.COM--}}
            {{--</div>--}}
            {{--</div>--}}
        @endif
    </div>
@stop