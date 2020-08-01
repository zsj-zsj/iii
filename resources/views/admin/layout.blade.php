<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">

    <title>@yield('title')</title>

    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico"> <link href="/style/adminStyle/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/style/adminStyle/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/style/adminStyle/css/animate.css" rel="stylesheet">
    <link href="/style/adminStyle/css/style.css?v=4.1.0" rel="stylesheet">

    <script src="/style/adminStyle/js/jquery.min.js?v=2.1.4"></script>
    <script src="/style/adminStyle/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/style/adminStyle/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/style/adminStyle/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/style/adminStyle/js/plugins/layer/layer.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- 自定义js -->
    <script src="/style/adminStyle/js/hAdmin.js?v=4.1.0"></script>
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">

    <!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="nav-close"><i class="fa fa-times-circle"></i>
        </div>
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                                    <span class="block m-t-xs" style="font-size:20px;">
                                        <strong class="font-bold">🦁🐺🦅！admin</strong>
                                    </span>
                                </span>
                        </a>
                    </div>
                    <div class="logo-element">hAdmin
                    </div>
                </li>
                <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                    <span class="ng-scope"><i class="fa fa-home"></i></span>
                </li>
                <li>
                    <a class="J_menuItem" href="{{url('/admin/index')}}">
                        <i class="fa fa-home"></i>
                        <span class="nav-label">主页</span>
                    </a>
                </li>
                <li class="line dk"></li>
                <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                    <span class="ng-scope">用户管理</span>
                </li>

                <li>
                    <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">管理员</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a class="J_menuItem" href="{{url('admin/reg')}}">添加</a></li>
                        <li><a class="J_menuItem" href="{{url('admin/regIndex')}}">列表</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">角色</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a class="J_menuItem" href="{{url('admin/role/create')}}">添加</a></li>
                        <li><a class="J_menuItem" href="{{url('admin/role/index')}}">列表</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">权限</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a class="J_menuItem" href="{{url('admin/perm/create')}}">添加</a></li>
                        <li><a class="J_menuItem" href="{{url('admin/perm/index')}}">列表</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">角色权限</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a class="J_menuItem" href="{{url('admin/rolePerm/create')}}">添加</a></li>
                        <li><a class="J_menuItem" href="{{url('admin/rolePerm/index')}}">列表</a></li>
                    </ul>
                </li>
                <li class="line dk"></li>
                <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                    <span class="ng-scope">商品管理</span>
                </li>
                <li>
                    <a href="#"><i class="fa fa-flask"></i> <span class="nav-label">品牌</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a class="J_menuItem" href="{{url('admin/brand/create')}}">添加</a></li>
                        <li><a class="J_menuItem" href="{{url('admin/brand/index')}}">列表</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-flask"></i> <span class="nav-label">分类</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a class="J_menuItem" href="{{url('admin/cate/create')}}">添加</a></li>
                        <li><a class="J_menuItem" href="{{url('admin/cate/index')}}">列表</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-flask"></i> <span class="nav-label">类型</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a class="J_menuItem" href="{{url('admin/type/create')}}">添加</a></li>
                        <li><a class="J_menuItem" href="{{url('admin/type/index')}}">列表</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-flask"></i> <span class="nav-label">属性</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a class="J_menuItem" href="{{url('admin/attr/create')}}">添加</a></li>
                        <li><a class="J_menuItem" href="{{url('admin/attr/index')}}">列表</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-flask"></i> <span class="nav-label">商品</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a class="J_menuItem" href="{{url('admin/goods/create')}}">添加</a></li>
                        <li><a class="J_menuItem" href="{{url('admin/goods/index')}}">列表</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-flask"></i> <span class="nav-label">商品属性</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a class="J_menuItem" href="{{url('admin/goodsAttr/index')}}">商品属性列表</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-flask"></i> <span class="nav-label">SKU库存管理</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a class="J_menuItem" href="{{url('admin/goodsSku/goodSouch')}}">添加</a></li>
                        <li><a class="J_menuItem" href="{{url('admin/goodsSku/index')}}">列表</a></li>
                    </ul>
                </li>
                <li class="line dk"></li>
            </ul>
        </div>
    </nav>
    <!--左侧导航结束-->
    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-info " href="#"><i class="fa fa-bars"></i> </a>
                    <form role="search" class="navbar-form-custom" method="post" action="search_results.html">
                        <div class="form-group">
                            <input type="text" placeholder="请输入您需要查找的内容 …" class="form-control" name="top-search" id="top-search">
                        </div>
                    </form>
                </div>
                <ul class="nav navbar-top-links navbar-right">

                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-qq fa-fw"></i> <span class="label label-primary"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li>
                                <div>
                                    欢迎<b style="color: red">{{session('name')}}</b>登录
                                    <span class="pull-right text-muted small">登录时间：{{session('time')}}</span>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div>
                                    <a href="{{url('/adminQuit')}}">退出登录</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>

        @yield('content')

</body>

</html>
