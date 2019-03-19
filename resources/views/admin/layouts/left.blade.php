<?php
$user = \Illuminate\Support\Facades\Auth::user();
$request = request();
$requestUrl = $request->url();

$menuItems = [
        [
                'label' => '用户管理',
                'icon' => 'user',
                'url' => '#',
                'items' => [
                        [
                                'label' => '用户',
                                'url' => route('m.users'),
                        ],
                        [
                                'label' => '权限',
                                'url' => '/admin/permission',
                                'items' => [
                                    [
                                        'label' => '角色权限',
                                        'url' => route('m.roles'),
                                    ],
                                ]
                        ],
                ]
        ],
        [
                'label' => '回到首页',
                'icon' => 'home',
                'url' => route('m.welcome'),
        ],
];
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{$user->avatar}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{$user->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                                    class="fa fa-search"></i>
                        </button>
                      </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header">菜单</li>
            <?php foreach($menuItems as $menuItem):?>
            <li class="treeview <?php
            if (isset($menuItem['items']) && is_array($menuItem['items'])) {
                $active = 0;
                foreach ($menuItem['items'] as $it) {
                    if(isset($it['items'])&&is_array($it['items'])){
                        foreach($it['items'] as $secItem){
                            if (strpos($requestUrl, $secItem['url']) > -1) {
                                $active = 1;
                                break 2;
                            }
                        }
                    }
                    if (strpos($requestUrl, $it['url']) > -1) {
                        $active = 1;
                        break;
                    }
                }
                if ($active == 1) {
                    echo 'active';
                }
            }
            ?>">
                <a href="{{$menuItem['url']}}">
                    <i class="fa fa-{{$menuItem['icon']}}"></i>
                    <span>{{$menuItem['label']}}</span>
                    @if(isset($menuItem['items'])&&is_array($menuItem['items']))
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    @endif
                </a>
                @if(isset($menuItem['items'])&&is_array($menuItem['items']))
                    <ul class="treeview-menu">
                        <?php foreach($menuItem['items'] as $item):?>
                        @if(isset($item['items'])&&is_array($item['items']))
                            <li class="{{strpos($requestUrl,$item['url'])>-1?'active':''}} treeview">
                                <a href="{{$item['url']}}"><i class="fa fa-circle-o"></i> {{$item['label']}}
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <?php foreach($item['items'] as $secondItem):?>
                                    <li class="{{strpos($requestUrl,$secondItem['url'])>-1?'active':''}}">
                                        <a href="{{$secondItem['url']}}">
                                            <i class="fa fa-circle-o"></i> {{$secondItem['label']}}
                                        </a>
                                    </li>
                                    <?php endforeach;?>
                                </ul>
                            </li>
                        @else
                            <li class="{{strpos($requestUrl,$item['url'])>-1?'active':''}}"><a href="{{$item['url']}}"><i
                                            class="fa fa-circle-o"></i> {{$item['label']}}</a></li>
                        @endif
                        <?php endforeach;?>
                    </ul>
                @endif
            </li>
            <?php endforeach;?>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>