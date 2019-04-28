@extends("admin.layouts.app")
@section('subTitle')
    编辑权限组
@endsection
@section('template')
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">编辑权限组</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post">
                    {{csrf_field()}}
                    <div class="box-body">
                        <div class="form-group {{$errors->has('name')?"has-error":""}}">
                            <label class="col-sm-2 control-label">角色名称</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" value="{{old('name')??$role->name}}" class="form-control"
                                       placeholder="请填写角色名称，字母数字下划线组合，格式A-Za-z0-9">
                                @if($errors->has('name'))
                                    <span class="help-block">
                                     <strong>{{ $errors->first('name') }}</strong>
                                 </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group {{$errors->has('display_name')?"has-error":""}}">
                            <label class="col-sm-2 control-label">角色显示名称</label>
                            <div class="col-sm-10">
                                <input type="text" name="display_name"
                                       value="{{old('display_name')??$role->display_name}}" class="form-control"
                                       placeholder="请填写角色显示名称，汉字">
                                @if($errors->has('display_name'))
                                    <span class="help-block">
                                     <strong>{{ $errors->first('display_name') }}</strong>
                                 </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group {{$errors->has('description')?"has-error":""}}">
                            <label class="col-sm-2 control-label">权限组描述</label>
                            <div class="col-sm-10">
                                <input type="text" name="description" value="{{old('description')??$role->description}}"
                                       class="form-control" placeholder="请填写权限组描述">
                                @if($errors->has('description'))
                                    <span class="help-block">
                                     <strong>{{ $errors->first('description') }}</strong>
                                 </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info">保存</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>

        <div class="col-xs-12 col-md-6">
            <div class="box box-info" id="vvvv">
                <div class="box-header with-border">
                    <h3 class="box-title">配置权限(@{{checkedPermissions.length}})</h3>
                    <small></small>
                </div>
                <div class="box-body">
                    <a class="btn btn-flat margin"
                       v-bind:class="{'bg-gray':!isChecked(p.id),'bg-olive':isChecked(p.id)}" v-for="p in permissions"
                       v-on:click="check(p.id)"
                       v-bind:title="p.description"
                    >
                        <span class="fa fa-circle-o" v-if="!isChecked(p.id)"></span>
                        <span class="fa fa-check-circle" v-if="isChecked(p.id)"></span>
                        @{{p.display_name}}
                    </a>
                </div>
                <div class="box-footer">
                    <a href="javascript:" class="btn btn-info" v-on:click="save" v-bind:disabled="!changed">保存</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("script")
    <script>
        $(function () {
            var v = new Vue({
                el: "#vvvv",
                data: {
                    api: '{{route("a.roleApi",['id'=>$id])}}',
                    changed:false,
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
                        $.post(this.api,{
                            'method':'getPermissions'
                        },function(data){
                            self.permissions = data;
                        });
                    },
                    getCheckedPermissions:function(){
                        var self = this;
                        $.post(this.api,{
                            'method':'getCheckedPermissions'
                        },function(data){
                            self.checkedPermissions = data;
                        });
                    },
                    check: function (permission) {
                        this.changed = true;
                        for (var i in this.checkedPermissions) {
                            if (permission === this.checkedPermissions[i]) {
                                //移除
                                this.checkedPermissions.splice(i, 1);
                                return;
                            }
                        }
                        this.checkedPermissions.push(permission);
                    },
                    isChecked: function (permission) {
                        for (var i in this.checkedPermissions) {
                            if (this.checkedPermissions[i] === permission) {
                                return true;
                            }
                        }
                        return false;
                    },
                    save:function(){
                        if(!this.changed){
                            return;
                        }
                        var self = this;
                        $.post(this.api,{
                            'method':'updateRolePermissions',
                            'permissions':this.checkedPermissions,
                        },function(data){
                            alert(data.message);
                            self.changed = false;
                        });
                    }
                }
            });
            v.boot();
        });
    </script>
@endsection