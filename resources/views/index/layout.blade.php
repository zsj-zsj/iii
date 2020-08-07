<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" rel="stylesheet" href="/style/indexStyle/css/style.css" />
    <!--[if IE 6]>
    <script src="/style/indexStyle/js/iepng.js" type="text/javascript"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a');
    </script>
    <![endif]-->
    <script type="text/javascript" src="/style/indexStyle/js/jquery-1.11.1.min_044d0927.js"></script>
    <script type="text/javascript" src="/style/indexStyle/js/jquery.bxslider_e88acd1b.js"></script>
    <script type="text/javascript" src="/style/indexStyle/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="/style/indexStyle/js/menu.js"></script>
    <script type="text/javascript" src="/style/indexStyle/js/select.js"></script>
    <script type="text/javascript" src="/style/indexStyle/js/lrscroll.js"></script>
    <script type="text/javascript" src="/style/indexStyle/js/iban.js"></script>
    <script type="text/javascript" src="/style/indexStyle/js/fban.js"></script>
    <script type="text/javascript" src="/style/indexStyle/js/f_ban.js"></script>
    <script type="text/javascript" src="/style/indexStyle/js/mban.js"></script>
    <script type="text/javascript" src="/style/indexStyle/js/bban.js"></script>
    <script type="text/javascript" src="/style/indexStyle/js/hban.js"></script>
    <script type="text/javascript" src="/style/indexStyle/js/tban.js"></script>
    <script type="text/javascript" src="/style/indexStyle/js/lrscroll_1.js"></script>
{{--    分类菜单样式--}}
    <script type="text/javascript" src="/style/indexStyle/js/n_nav.js"></script>
{{--详情样式--}}
    <link rel="stylesheet" type="text/css" href="/style/indexStyle/css/ShopShow.css" />
    <link rel="stylesheet" type="text/css" href="/style/indexStyle/css/MagicZoom.css" />
    <script type="text/javascript" src="/style/indexStyle/js/MagicZoom.js"></script>
    <script type="text/javascript" src="/style/indexStyle/js/num.js">
        var jq = jQuery.noConflict();
    </script>
    <script type="text/javascript" src="/style/indexStyle/js/p_tab.js"></script>
    <script type="text/javascript" src="/style/indexStyle/js/shade.js"></script>
{{--    分页--}}
    <link rel="stylesheet" href="/style/indexStyle/limit/bootstrap.min.css">
    <script src="/style/indexStyle/limit/jquery.min.js"></script>
    <script src="/style/indexStyle/limit/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
</head>
<body>
{{--头--}}
<div class="soubg">
    <div class="sou">
        <span class="fr">
        	<span class="fl">
                @if(!session('user'))
                你好，请<a href="{{url('login')}}">登录</a>&nbsp; <a href="{{url('reg')}}" style="color:#ff4e00;">免费注册</a>
                @else
                    欢迎 <b style="color: red">{{session('user.user_name')}}</b>登录 | <a href="{{url('Quit')}}">退出登录</a>
                @endif
                &nbsp;|&nbsp;<a href="">我的订单</a>&nbsp;
            </span>
            <span class="fl">|&nbsp;关注我们：</span>
            <span class="s_sh"><a href="#" class="sh1">新浪</a><a href="#" class="sh2">微信</a></span>
            <span class="fr">|&nbsp;<a href="#">手机版&nbsp;<img src="/style/indexStyle/images/s_tel.png" align="absmiddle" /></a></span>
        </span>
    </div>
</div>

{{--搜索--}}
<div class="top">
    <div class="logo"><a href="javascript:;"><img src="/style/indexStyle/images/logo.png" /></a></div>
    <div class="search">
        <form>
            <input type="text" value="" class="s_ipt" />
            <input type="button" id="souch" value="搜索" class="s_btn"  />
        </form>
    </div>
    <div class="i_car">
        <div class="car_t">购物车</div>
        <div class="car_bg">
            @if(!session('user'))
                <div class="un_login">还未登录！<a href="{{url('login')}}" style="color:#ff4e00;">马上登录</a> 查看购物车！</div>
            @else
                <div class="price_a"><a href="{{url('shop/cartList')}}">购物车列表</a></div>
            @endif
        </div>
    </div>
</div>

@yield('content')

{{--底部--}}
<div class="b_btm_bg b_btm_c">
    <div class="b_btm">
        <table border="0" style="width:210px; height:62px; float:left; margin-left:75px; margin-top:30px;" cellspacing="0" cellpadding="0">
            <tr>
                <td width="72"><img src="/style/indexStyle/images/b1.png" width="62" height="62" /></td>
                <td><h2>正品保障</h2>正品行货  放心购买</td>
            </tr>
        </table>
        <table border="0" style="width:210px; height:62px; float:left; margin-left:75px; margin-top:30px;" cellspacing="0" cellpadding="0">
            <tr>
                <td width="72"><img src="/style/indexStyle/images/b2.png" width="62" height="62" /></td>
                <td><h2>满38包邮</h2>满38包邮 免运费</td>
            </tr>
        </table>
        <table border="0" style="width:210px; height:62px; float:left; margin-left:75px; margin-top:30px;" cellspacing="0" cellpadding="0">
            <tr>
                <td width="72"><img src="/style/indexStyle/images/b3.png" width="62" height="62" /></td>
                <td><h2>天天低价</h2>天天低价 畅选无忧</td>
            </tr>
        </table>
        <table border="0" style="width:210px; height:62px; float:left; margin-left:75px; margin-top:30px;" cellspacing="0" cellpadding="0">
            <tr>
                <td width="72"><img src="/style/indexStyle/images/b4.png" width="62" height="62" /></td>
                <td><h2>准时送达</h2>收货时间由你做主</td>
            </tr>
        </table>
    </div>
</div>
<div class="b_nav">
    <dl>
        <dt><a href="#">新手上路</a></dt>
        <dd><a href="#">售后流程</a></dd>
        <dd><a href="#">购物流程</a></dd>
        <dd><a href="#">订购方式</a></dd>
        <dd><a href="#">隐私声明</a></dd>
        <dd><a href="#">推荐分享说明</a></dd>
    </dl>
    <dl>
        <dt><a href="#">配送与支付</a></dt>
        <dd><a href="#">货到付款区域</a></dd>
        <dd><a href="#">配送支付查询</a></dd>
        <dd><a href="#">支付方式说明</a></dd>
    </dl>
    <dl>
        <dt><a href="#">会员中心</a></dt>
        <dd><a href="#">资金管理</a></dd>
        <dd><a href="#">我的收藏</a></dd>
        <dd><a href="#">我的订单</a></dd>
    </dl>
    <dl>
        <dt><a href="#">服务保证</a></dt>
        <dd><a href="#">退换货原则</a></dd>
        <dd><a href="#">售后服务保证</a></dd>
        <dd><a href="#">产品质量保证</a></dd>
    </dl>
    <dl>
        <dt><a href="#">联系我们</a></dt>
        <dd><a href="#">网站故障报告</a></dd>
        <dd><a href="#">购物咨询</a></dd>
        <dd><a href="#">投诉与建议</a></dd>
    </dl>
    <div class="b_tel_bg">
        <a href="#" class="b_sh1">新浪微博</a>
        <a href="#" class="b_sh2">腾讯微博</a>
        <p>
            服务热线：<br />
            <span>400-123-4567</span>
        </p>
    </div>
    <div class="b_er">
        <div class="b_er_c"><img src="/style/indexStyle/images/er.gif" width="118" height="118" /></div>
        <img src="/style/indexStyle/images/ss.png" />
    </div>
</div>
<div class="btmbg">
    <div class="btm">
        备案/许可证编号：蜀ICP备12009302号-1-www.dingguagua.com   Copyright © 2015-2018 尤洪商城网 All Rights Reserved. 复制必究 , Technical Support: Dgg Group <br />
        <img src="/style/indexStyle/images/b_1.gif" width="98" height="33" /><img src="/style/indexStyle/images/b_2.gif" width="98" height="33" /><img src="/style/indexStyle/images/b_3.gif" width="98" height="33" /><img src="/style/indexStyle/images/b_4.gif" width="98" height="33" /><img src="/style/indexStyle/images/b_5.gif" width="98" height="33" /><img src="/style/indexStyle/images/b_6.gif" width="98" height="33" />
    </div>
</div>
</div>

</body>
</html>

<script>
    $(document).on('click','#souch',function () {
        location.href='http://www.baidu.com'
    })
</script>
