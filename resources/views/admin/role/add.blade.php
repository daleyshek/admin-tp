@extends("admin.layouts.app")
@section('subTitle')
    新增权限组
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">添加权限组</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post">
                    {{csrf_field()}}
                    <div class="box-body">
                        <div class="form-group {{$errors->has('name')?"has-error":""}}">
                            <label class="col-sm-2 control-label">角色名称</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="请填写角色名称，字母数字下划线组合，格式A-Za-z0-9">
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
                                <input type="text" name="display_name" value="{{old('display_name')}}" class="form-control" placeholder="请填写角色显示名称，汉字">
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
                                <input type="text" name="description" value="{{old('description')}}" class="form-control" placeholder="请填写权限组描述">
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
                        <button type="submit" class="btn btn-info">添加</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
@endsection