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
                'url' => route('a.users'),
            ],
            [
                'label' => '权限',
                'url' => '/admin/permission',
                'items' => [
                    [
                        'label' => '角色权限',
                        'url' => route('a.roles'),
                    ],
                ]
            ],
        ]
    ],
    [
        'label' => '回到首页',
        'icon' => 'home',
        'url' => route('a.welcome'),
    ],
];
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link text-center">
      <span class="brand-text font-weight-light">{{config('app.name')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{$user->avatar}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{$user->name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="搜索" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <?php foreach($menuItems as $menuItem):?>
                <?php
                    $active = 0;
                    if (isset($menuItem['items']) && is_array($menuItem['items'])) {
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
                    }
                ?>
                <li class="nav-item {{$active?'menu-open':''}}">
                    <a href="{{$menuItem['url']}}" class="{{$active?'active':''}} nav-link">
                        <i class="nav-icon fas fa-{{$menuItem['icon']}}"></i>
                        <p>
                            <span>{{$menuItem['label']}}</span>
                            @if(isset($menuItem['items'])&&is_array($menuItem['items']))
                                <i class="right fas fa-angle-left"></i>
                            @endif
                        </p>
                    </a>
                    @if(isset($menuItem['items'])&&is_array($menuItem['items']))
                        <ul class="nav nav-treeview">
                            <?php foreach($menuItem['items'] as $item):?>
                            @if(isset($item['items'])&&is_array($item['items']))
                                <li class="nav-item">
                                    <a href="{{$item['url']}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i> 
                                        <p>{{$item['label']}}</p>
                                        <i class="fas fa-angle-left right"></i>
                                    </a>
                                    <ul class="nav nav-treeview {{strpos($requestUrl,$item['url'])>-1?'menu-open':''}}">
                                        <?php foreach($item['items'] as $secondItem):?>
                                        <li class="nav-item">
                                            <a href="{{$secondItem['url']}}" class="{{strpos($requestUrl,$secondItem['url'])>-1?'active':''}} nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>{{$secondItem['label']}}</p>
                                            </a>
                                        </li>
                                        <?php endforeach;?>
                                    </ul>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a href="{{$item['url']}}" class="{{strpos($requestUrl,$item['url'])>-1?'active':''}} nav-link">
                                        <i class="far fa-circle nav-icon"></i> 
                                        <p>{{$item['label']}}</p>
                                    </a>
                                </li>
                            @endif
                            <?php endforeach;?>
                        </ul>
                    @endif
                    </li>
                    <?php endforeach;?>
            </ul>
        </nav>
        <!-- /.Sidebar Menu -->
    </div>
</aside>