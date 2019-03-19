@extends("admin.layouts.app")


@section("content")
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$data['try_devices_count']}}</h3>

                    <p>设备待登记</p>
                </div>
                <div class="icon">
                    <i class="fa fa-mobile"></i>
                </div>
                <a href="{{$data['try_device']?route("m.editUser",['id'=>$data['try_device']->user_id]):'#'}}" class="small-box-footer">更多信息<i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{$data['active_today']}}</h3>

                    <p>今日活跃用户</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
                <a href="{{route("m.users")}}" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{$data['inspections_today']}}</h3>

                    <p>今日巡检</p>
                </div>
                <div class="icon">
                    <i class="fa fa-gear"></i>
                </div>
                <a href="{{route("m.inspections")}}" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>0</h3>

                    <p>今日异常</p>
                </div>
                <div class="icon">
                    <i class="fa fa-exclamation-triangle"></i>
                </div>
                <a href="#" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
@endsection
