@extends("admin.layouts.app")
@section('subTitle')
    用户列表
@endsection
@section("content")
    <a href="{{route('m.addUser')}}" class="btn btn-info btn-sm">新增用户</a>
    <table-list></table-list>
    {{--<div class="box box-info">
        <div class="box-header">
        </div>
        <div class="box-body">
            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th>UID</th>
                        <th>用户名</th>
                        <th>手机号</th>
                        <th>姓名</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>admin</td>
                        <td></td>
                        <td>管理员</td>
                        <td><span class="label label-success">正常</span></td>
                        <td><div class="btn-group">
                                <a href="#" class="btn btn-default btn-xs">设备</a>
                                <a href="#" class="btn btn-default btn-xs">编辑</a>
                                <a href="" class="btn btn-danger btn-xs">禁用</a>
                            </div></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>admin</td>
                        <td></td>
                        <td>管理员</td>
                        <td><span class="label label-success">正常</span></td>
                        <td><div class="btn-group">
                                <a href="#" class="btn btn-default btn-xs">设备</a>
                                <a href="#" class="btn btn-default btn-xs">编辑</a>
                                <a href="" class="btn btn-danger btn-xs">禁用</a>
                            </div></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">«</a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">»</a></li>
            </ul>
        </div>
    </div>--}}
@endsection