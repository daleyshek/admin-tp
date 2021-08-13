@extends("admin.layouts.app")
@section('subTitle')
    用户列表
@endsection
@section("content")
    <a href="{{route('a.addUser')}}"  class="btn btn-primary btn-sm mb">新增用户</a>
    <div class="row" >
        <div class="col-12">
            <table-list show-page-size show-search></table-list>
        </div>
    </div>
@endsection