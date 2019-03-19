@extends("admin.layouts.app")
@section('subTitle')
    编辑用户
@endsection
@section('template')
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">编辑用户</h3>
                    <div class="btn-group pull-right">
                        {!! $user->status_label !!}
                    </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post">
                    {{csrf_field()}}
                    <div class="box-body">
                        <div class="form-group {{$errors->has('name')?"has-error":""}}">
                            <label class="col-sm-2 control-label">头像</label>
                            <div class="col-sm-10">
                                <img src="{{$user->avatar}}" class="img img-circle" style="width:100px;height:100px;">
                                <div style="padding:10px 20px;">
                                    <a href="javascript:" class="btn btn-default btn-sm" disabled>上传头像</a>
                                </div>
                                <input type="hidden" name="name" value="{{$user->avatar}}" class="form-control"
                                       placeholder="">
                                @if($errors->has('avatar'))
                                    <span class="help-block">
                                     <strong>{{ $errors->first('avatar') }}</strong>
                                 </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('name')?"has-error":""}}">
                            <label class="col-sm-2 control-label">用户名</label>

                            <div class="col-sm-10">
                                <input type="text" name="name" value="{{$user->name}}" class="form-control"
                                       placeholder="请填写登陆用户名，用于App和后台系统登陆，建议英文名称或者手机号码">
                                @if($errors->has('name'))
                                    <span class="help-block">
                                     <strong>{{ $errors->first('name') }}</strong>
                                 </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('password')?"has-error":""}}">
                            <label class="col-sm-2 control-label">重置密码</label>

                            <div class="col-sm-10">
                                <input type="password" name="password" value="" class="form-control"
                                       placeholder="如需重置密码，请直接输入新密码并保存">
                                @if($errors->has('password'))
                                    <span class="help-block">
                                     <strong>{{ $errors->first('password') }}</strong>
                                 </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('mobile')?"has-error":""}}">
                            <label class="col-sm-2 control-label">手机号</label>

                            <div class="col-sm-10">
                                <input type="text" name="mobile" value="{{$user->mobile}}" class="form-control"
                                       placeholder="请填写手机号" disabled>
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
                                    <label><input type="radio" name="gender"
                                                  value="1" {{$user->gender==1?'checked':''}}> <span
                                                class="label label-success">男</span></label>
                                    <label><input type="radio" name="gender"
                                                  value="2" {{$user->gender==2?'checked':''}}> <span
                                                class="label label-success">女</span></label>
                                </div>

                                @if($errors->has('gender'))
                                    <span class="help-block">
                                     <strong>{{ $errors->first('gender') }}</strong>
                                 </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{($errors->has('role')||count($roles)==0)?"has-error":""}}">
                            <label class="col-sm-2 control-label">授权权限组</label>

                            <div class="col-sm-10">
                                <select name="role" class="form-control">
                                    <option value="">请分配授权组</option>
                                    @foreach($roleOptions as $r)
                                        <option value="{{$r->name}}" {{$userRole == $r->name?'selected':null}}>{{$r->display_name}}
                                            ({{$r->description}})
                                        </option>
                                    @endforeach
                                </select>
                                @if($errors->has('role'))
                                    <span class="help-block">
                                     <strong>{{ $errors->first('role') }}</strong>
                                 </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('email')?"has-error":""}}">
                            <label class="col-sm-2 control-label">邮箱</label>

                            <div class="col-sm-10">
                                <input type="text" name="email" value="{{$user->email}}" class="form-control"
                                       placeholder="请填写邮箱，可选" disabled>
                                @if($errors->has('email'))
                                    <span class="help-block">
                                     <strong>{{ $errors->first('email') }}</strong>
                                 </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('status')?"has-error":""}}">
                            <label class="col-sm-2 control-label">用户状态</label>
                            <div class="col-sm-10">
                                <select name="status" class="form-control">
                                    @foreach(\App\Models\User::STATUS_TEXTS as $k=>$v)
                                    <option value="{{$k}}" @if($k==$user->status) selected @endif>{{$v}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('status'))
                                    <span class="help-block">
                                     <strong>{{ $errors->first('status') }}</strong>
                                 </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <input type="submit" class="btn btn-info" value="保存">
                        <a href="javascript:" id="delBtn" class="btn btn-danger">删除</a>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>


        <div class="col-xs-12 col-md-6">
            <div class="box box-info" id="vvvv">
                <div class="box-header with-border">
                    <h3 class="box-title">用户所有权限</h3>
                    <small>鼠标悬浮可查看权限描述</small>
                </div>
                <div class="box-body">
                    <a class="btn btn-flat margin"
                       v-bind:class="{'bg-gray':!isChecked(p.id),'bg-olive':isChecked(p.id)}" v-for="p in permissions"
                       v-bind:title="p.description"
                    >
                        <span class="fa fa-circle-o" v-if="!isChecked(p.id)"></span>
                        <span class="fa fa-check-circle" v-if="isChecked(p.id)"></span>
                        @{{p.display_name}}
                    </a>
                </div>
                <div class="box-footer">

                </div>
            </div>
        </div>
@endsection
@section("script")
    <script>
        $('#delBtn').click(function(){
            if(window.confirm("确定删除该用户？删除后如果要恢复请联系开发者")){
                $.get("{{route("m.deleteUser",['id'=>$user->id])}}",function(data){
                    if (data == 'success'){
                        window.location.href = '{{route('m.users')}}';
                    }
                })
            }
        });

        $(function () {
            var v = new Vue({
                el: "#vvvv",
                data: {
                    api: '{{route("m.roleApi",['id'=>count($roles)>0?$roles[0]->id:0])}}',
                    changed: false,
                    checkedPermissions: [],
                    permissions: []
                },
                methods: {
                    boot: function () {
                        this.getPermissions();
                        this.getCheckedPermissions();
                    },
                    getPermissions: function () {
                        var self = this;
                        $.post(this.api, {
                            'method': 'getPermissions'
                        }, function (data) {
                            self.permissions = data;
                        });
                    },
                    getCheckedPermissions: function () {
                        var self = this;
                        $.post(this.api, {
                            'method': 'getCheckedPermissions'
                        }, function (data) {
                            self.checkedPermissions = data;
                        });
                    },
                    isChecked: function (permission) {
                        for (var i in this.checkedPermissions) {
                            if (this.checkedPermissions[i] === permission) {
                                return true;
                            }
                        }
                        return false;
                    },
                }
            });
            v.boot();
        });
    </script>
@endsection