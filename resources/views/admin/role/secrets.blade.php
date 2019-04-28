@extends("admin.layouts.app")
@section('subTitle')
    口令列表
@endsection
@section('content')
    <a href="{{route('a.addSecret')}}" class="btn btn-info btn-sm">新增口令</a>
    <table-list></table-list>
@endsection