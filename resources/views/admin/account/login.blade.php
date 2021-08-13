<!DOCTYPE html>
<html>
<head>
    <meta charset="{{app()->getLocale()}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{config('app.name').'-后台管理系统'}}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="{{asset('assets/css/admin_common.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/admin-lte.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="">
            <small>{{config('app.name')}}管理系统登陆</small>
        </a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body" id="app">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h4>{{config('app.name')}}</h4>
            </div>
            <div class="card-body">
                <p class="login-box-msg">输入您的账号密码登陆系统</p>
                @if(isset($errors)&&count($errors) >0)
                    <div class="alert alert-danger"
                        style="background-color:#f2dede!important;border-color: #ebccd1!important;color:#a94442!important">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="" method="post">
                    {{csrf_field()}}
                    <div class="form-group has-feedback">
                        <input type="text" name="mobile" class="form-control" placeholder="手机号" value="{{old('mobile')}}">
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="password" class="form-control" placeholder="密码" value="">
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> 记住我
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">登陆</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <a href="#">忘记密码</a><br>
            </div>
        </div>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<script src="{{asset('assets/js/admin_common.js')}}"></script>
</body>
</html>
