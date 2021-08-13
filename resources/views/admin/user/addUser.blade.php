@extends("admin.layouts.app")
@section('subTitle')
    添加新用户
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">添加用户</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post">
                    {{csrf_field()}}
                    <div class="box-body">
                        <div class="form-group {{$errors->has('name')?"has-error":""}}">
                            <label class="col-sm-2 control-label">用户名</label>

                            <div class="col-sm-10">
                                <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="请填写登陆用户名，用于App和后台系统登陆，建议英文名称或者手机号码">
                                @if($errors->has('name'))
                                 <span class="help-block">
                                     <strong>{{ $errors->first('name') }}</strong>
                                 </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('password')?"has-error":""}}">
                            <label class="col-sm-2 control-label">密码</label>

                            <div class="col-sm-10">
                                <input type="password" name="password" value="{{old('password')}}" class="form-control" placeholder="请填写密码,必须包含字母和数字">
                                @if($errors->has('password'))
                                <span class="help-block">
                                     <strong>{{ $errors->first('password') }}</strong>
                                 </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('password_repeat')?"has-error":""}}">
                            <label class="col-sm-2 control-label">重复密码</label>

                            <div class="col-sm-10">
                                <input type="password" name="password_repeat" value="{{old('password_repeat')}}" class="form-control" placeholder="请再次填写密码">
                                @if($errors->has('password_repeat'))
                                    <span class="help-block">
                                     <strong>{{ $errors->first('password_repeat') }}</strong>
                                 </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('mobile')?"has-error":""}}">
                            <label class="col-sm-2 control-label">手机号</label>

                            <div class="col-sm-10">
                                <input type="text" name="mobile" value="{{old('mobile')}}" class="form-control" placeholder="请填写手机号">
                                @if($errors->has('mobile'))
                                    <span class="help-block">
                                     <strong>{{ $errors->first('mobile') }}</strong>
                                 </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('gender')?"has-error":""}}">
                            <label class="col-sm-2 control-label">性别</label>

                            <div class="col-sm-10">
                                <div class="checkbox">
                                    <label><input type="radio" name="gender" value="1" checked> <span class="label label-success">男</span></label>
                                    <label><input type="radio" name="gender" value="2"> <span class="label label-success">女</span></label>
                                </div>

                                @if($errors->has('gender'))
                                    <span class="help-block">
                                     <strong>{{ $errors->first('gender') }}</strong>
                                 </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('email')?"has-error":""}}">
                            <label class="col-sm-2 control-label">邮箱</label>

                            <div class="col-sm-10">
                                <input type="text" name="email" value="{{old('email')}}" class="form-control" placeholder="请填写邮箱，可选">
                                @if($errors->has('email'))
                                    <span class="help-block">
                                     <strong>{{ $errors->first('email') }}</strong>
                                 </span>
                                @endif
                            </div>
                        </div>


                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">添加</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
@endsection