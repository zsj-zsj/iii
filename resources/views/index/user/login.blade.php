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
    <link href="/style/adminStyle/css/font-awesome.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>登录</title>
</head>
<style>
    #eye{
        position: absolute;
        left: 88%;
        top : 438px;
        margin-left: -7%;
    }
</style>
<body>
<!--Begin Header Begin-->
<div class="soubg">
    <div class="sou">
        <span class="fr">
        	<span class="fl">你好，请<a href="{{url('login')}}">登录</a>&nbsp; <a href="{{url('reg')}}" style="color:#ff4e00;">免费注册</a>&nbsp; </span>
            <span class="fl">|&nbsp;关注我们：</span>
            <span class="s_sh"><a href="#" class="sh1">新浪</a><a href="#" class="sh2">微信</a></span>
            <span class="fr">|&nbsp;<a href="#">手机版&nbsp;<img src="/style/indexStyle/images/s_tel.png" align="absmiddle" /></a></span>
        </span>
    </div>
</div>
<!--End Header End-->
<!--Begin Login Begin-->
<div class="log_bg">
    <div class="top">
        <div class="logo"><a href="{{url('/')}}"><img src="/style/indexStyle/images/logo.png" /></a></div>
    </div>
    <div class="login">
        <div class="log_img"><img src="/style/indexStyle/images/l_img.png" width="611" height="425" /></div>
        <div class="log_c">
            <form method="post">
                <table border="0" style="width:370px; font-size:14px; margin-top:30px;" cellspacing="0" cellpadding="0">
                    <tr height="50" valign="top">
                        <td width="55">&nbsp;</td>
                        <td>
                            <span class="fl" style="font-size:24px;">登录</span>
                            <span class="fr">还没有商城账号，<a href="{{url('reg')}}" style="color:#ff4e00;">立即注册</a></span>
                        </td>
                    </tr>
                    <tr height="70">
                        <td>用户名</td>
                        <td><input type="text" name="user_name" class="l_user" /></td>
                    </tr>
                    <tr height="70">
                        <td>密&nbsp; &nbsp; 码</td>
                        <td>
                            <div>
                                <span style="cursor:pointer;"><i class="fa fa-eye"  id="eye"></i></span>
                            </div>
                            <input type="password" name="user_pwd" id="pass" class="l_pwd" />
                        </td>
                    </tr>
                    <tr height="70">
                        <td>验证码</td>
                        <td>
                            <input type="text" name="captcha"  class="l_ipt" />
                            <img src="{{captcha_src('default')}}"  style="cursor: pointer" onclick="this.src='{{captcha_src('default')}}'+Math.random()">
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td style="font-size:12px; padding-top:20px;">
                            <span><a href="{{url('/wxChat')}}" style="color: #00E8D7">微信登陆</a></span>
                            <span class="fr"><a href="#" style="color:#ff4e00;">忘记密码</a></span>
                        </td>
                    </tr>
                    <tr height="60">
                        <td>&nbsp;</td>
                        <td><input type="button" id="but" value="登录" class="log_btn" /></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<div class="btmbg">
    <div class="btm">
        QQ：3131466642<br />
        <img src="/style/indexStyle/images/b_1.gif" width="98" height="33" /><img src="/style/indexStyle/images/b_2.gif" width="98" height="33" /><img src="/style/indexStyle/images/b_3.gif" width="98" height="33" /><img src="/style/indexStyle/images/b_4.gif" width="98" height="33" /><img src="/style/indexStyle/images/b_5.gif" width="98" height="33" /><img src="/style/indexStyle/images/b_6.gif" width="98" height="33" />
    </div>
</div>
</body>
<!--[if IE 6]>
<script src="//letskillie6.googlecode.com/svn/trunk/2/zh_CN.js"></script>
<![endif]-->
</html>

<script>
    $(function(){
        $("#eye").mousedown(function(){
            $("#pass").attr("type", "text")
        })
        $("#eye").mouseup(function(){
            $("#pass").attr("type", "password")
        })
    })

    $(document).on('click','#but',function () {
        var name = $("input[name='user_name']").val()
        if(!name){
            alert('请输入用户名')
            return
        }
        var pwd = $("input[name='user_pwd']").val()
        if(!pwd){
            alert('请输入密码')
            return
        }
        var captcha = $("input[name='captcha']").val()
        if(!captcha){
            alert('请输入验证码')
            return
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $.post(
            "{{url('loginDo')}}",
            {user_name:name,user_pwd:pwd,captcha:captcha},
            function (res) {
                if(res.code == 0){
                    location.href='/'
                }else{
                    alert(res.msg)
                }
            }
        ),'json'
    })
</script>
