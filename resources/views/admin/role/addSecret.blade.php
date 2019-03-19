@extends("admin.layouts.app")
@section('subTitle')
    添加口令
@endsection
@section('template')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">添加口令</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post">
                    {{csrf_field()}}
                    <div class="box-body">
                        <div class="form-group {{$errors->has('secret')?"has-error":""}}">
                            <label class="col-sm-2 control-label">口令</label>
                            <div class="col-sm-10">
                                <input type="text" name="secret" value="{{old('secret')}}" class="form-control"
                                       placeholder="请填写口令，字母数字组合，格式A-Za-z0-9">
                                @if($errors->has('secret'))
                                    <span class="help-block">
                                     <strong>{{ $errors->first('secret') }}</strong>
                                 </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info">添加</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
@endsection
