@extends("admin.layouts.app")
@section('subTitle')
    权限组列表
@endsection
@section('content')
    <a href="{{route('a.addRole')}}" class="btn btn-primary btn-sm mb">新增权限组</a>
    <table-list></table-list>
@endsection