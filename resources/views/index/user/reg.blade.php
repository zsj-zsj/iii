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
    <link rel="stylesheet" href="/style/indexStyle/tabs/jquery-ui.min.css">
    <script src="/style/indexStyle/tabs/jquery.min.js"></script>
    <script src="/style/indexStyle/tabs/jquery-ui.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>注册</title>
</head>

<body>
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

<div class="log_bg">
    <div class="top">
        <div class="logo"><a href="{{url('/')}}"><img src="/style/indexStyle/images/logo.png" /></a></div>
    </div>
    <div class="regist">
        <div class="log_img"><img src="/style/indexStyle/images/l_img.png" width="611" height="425" /></div>
        <div class="reg_c">
            <div id="tabs">
                <ul>
                    <li><a href="#phone"><span>手机号注册</span></a></li>
                    <li><a href="#email"><span>邮箱注册</span></a></li>
                </ul>
                <div id="phone">
                    <li><a href="{{url('login')}}" style="color:#ff4e00;"><b>去登陆</b></a></li>
                    <form method="post" action="{{url('regMobile')}}">
                        @csrf
                        <table border="0" style="width:420px; font-size:14px; margin-top:20px;" cellspacing="0" cellpadding="0">
                            <tr height="50">
                                <td align="right">用户名 &nbsp;</td>
                                <td>
                                    <input type="text" id="m_user_name"  name="user_name"  class="l_user" />
                                    <p style="color:red"> @php echo $errors->first('user_name'); @endphp </p>
                                </td>
                            </tr>
                            <tr height="50">
                                <td align="right">密码 &nbsp;</td>
                                <td>
                                    <input type="password" id="m_user_pwd" name="user_pwd"  class="l_pwd" />
                                    <p style="color:red"> @php echo $errors->first('user_pwd'); @endphp </p>
                                </td>
                            </tr>
                            <tr height="50">
                                <td align="right">确认密码 &nbsp;</td>
                                <td><input type="password" id="m_user_pwds" name="user_pwds" class="l_pwd" /></td>
                            </tr>
                            <tr height="50">
                                <td align="right">手机 &nbsp;</td>
                                <td>
                                    <input type="text" id="m_user_mobile" name="user_mobile" class="l_tel" />
                                    <input type="button" id="sendMobile" class="btn btn-default" value="发送验证码" >
                                </td>
                            </tr>
                            <tr height="50">
                                <td align="right"> <font color="#ff4e00">*</font>&nbsp;验证码 &nbsp;</td>
                                <td>
                                    <input type="text" id="mobile_code" name="mobile_code" class="l_ipt" />
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td style="font-size:12px; padding-top:20px;">
                                <span style="font-family:'宋体';" class="fl">
                                    <label class="r_rad"><input type="checkbox" id="box" /></label><label class="r_txt">我已阅读并接受《用户协议》</label>
                                </span>
                                </td>
                            </tr>
                            <tr height="60">
                                <td>&nbsp;</td>
                                <td><input type="button" id="regMobile" value="立即注册" class="log_btn" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div id="email">
                    <li><a href="{{url('login')}}" style="color:#ff4e00;"><b>去登陆</b></a></li>
                    <form method="post" action="{{url('/regEmail')}}" >
                        @csrf
                        <table border="0" style="width:420px; font-size:14px; margin-top:20px;" cellspacing="0" cellpadding="0">
                            <tr height="50">
                                <td align="right"><font color="#ff4e00">*</font>&nbsp;用户名 &nbsp;</td>
                                <td>
                                    <input type="text" id="e_user_name" name="user_name" class="l_user" />
                                </td>
                            </tr>
                            <tr height="50">
                                <td align="right"><font color="#ff4e00">*</font>&nbsp;密码 &nbsp;</td>
                                <td>
                                    <input type="password" id="e_user_pwd" name="user_pwd1" class="l_pwd" />
                                    <p style="color:red"> @php echo $errors->first('user_pwd1'); @endphp </p>
                                </td>
                            </tr>
                            <tr height="50">
                                <td align="right"><font color="#ff4e00">*</font>&nbsp;确认密码 &nbsp;</td>
                                <td>
                                    <input type="password" id="e_user_pwds" name="user_pwd2" class="l_pwd" />
                                    <p style="color:red"> @php echo $errors->first('user_pwd2'); @endphp </p>
                                </td>

                            </tr>
                            <tr height="50">
                                <td align="right"><font color="#ff4e00">*</font>&nbsp;邮箱 &nbsp;</td>
                                <td>
                                    <input type="text" id="e_user_email" name="user_email" class="l_email" />
                                    <input type="button" id="sendEmail" class="btn btn-default" value="发送邮箱">
                                </td>
                            </tr>
                            <tr height="50">
                                <td align="right"> <font color="#ff4e00">*</font>&nbsp;验证码 &nbsp;</td>
                                <td>
                                    <input type="text" id="email_code" name="email_code" class="l_ipt" />
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td style="font-size:12px; padding-top:20px;">
                                <span style="font-family:'宋体';" class="fl">
                                    <label class="r_rad"><input type="checkbox" id="Ebox" /></label><label class="r_txt">我已阅读并接受《用户协议》</label>
                                </span>
                                </td>
                            </tr>
                            <tr height="60">
                                <td>&nbsp;</td>
                                <td><input type="button" id="regEmail" value="立即注册" class="log_btn" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <script>
                    $( "#tabs" ).tabs();
                </script>
            </div>
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
    $(document).on('click','#sendMobile',function () {
        var mobile = $("#m_user_mobile").val()
        var reg = /^1[3|6|9|8]\d{9}$/;
        if(!mobile){
            alert('手机号不能为空');
            return;
        }else if(!reg.test(mobile)) {
            alert('手机号格式不正确');
            return;
        }else {
            $("#sendMobile").val('60s')
            var time=setInterval(time,1000)
            $("#sendMobile").css('pointer-events','none')  //zhi hui
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $.post(
            "{{url('/regMobileSendCode')}}",
            {user_mobile:mobile},
            function (res) {
                if(res.code==0){
                    alert(res.msg)
                }
            }
        ),'json'
        function time(){
            t=$("#sendMobile").val()
            t=parseInt(t)
            if(t <= 0){
                $("#sendMobile").val('获取验证码')
                clearInterval(time)
                $("#sendMobile").css('pointer-events','auto')
            }else{
                t=t-1
                t= $("#sendMobile").val(t+'s')
                $("#sendMobile").css('pointer-events','none')
            }
        }
    })

    $(document).on('click','#regMobile',function () {
        var name = $("#m_user_name").val()
        if(!name){
            alert('请输入用户名')
            return
        }
        $.get(
            "{{url('/onlyName')}}",
            {user_name:name},
            function (res) {
                if(res.code == 500){
                    alert(res.msg)
                    return
                }
            }
        ),'json'
        var pwd = $("#m_user_pwd").val()
        if(!pwd){
            alert('请输入密码')
            return
        }
        if(pwd.length<6){
            alert('密码长度不够')
            return;
        }
        var pwds = $("#m_user_pwds").val()
        if(pwd != pwds){
            alert('密码不一致')
            return
        }
        var mobile = $("#m_user_mobile").val()
        if(!mobile){
            alert('请输入手机号')
            return
        }
        var reg = /^1[3|6|9|8]\d{9}$/;
        if(!reg.test(mobile)) {
            alert('手机号格式不正确');
            return;
        }
        var code = $("#mobile_code").val()
        if(!code){
            alert('请输入验证码')
            return
        }

        var box = $('#box').is(":checked")
        if(box==false){
            alert('请同意用户协议！')
            return
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $.post(
            "{{url('/regMobile')}}",
            {user_name:name,user_pwd:pwd,pwds:pwds,user_mobile:mobile,mobile_code:code},
            function (res) {
                if(res.code == 0){
                    location.href='/login'
                }else{
                    alert(res.msg)
                }
            }
        ),'json'
    })

    $(document).on('click','#sendEmail',function () {
        var email = $("#e_user_email").val()
        var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
        if(!email){
            alert('请输入邮箱')
            return
        }else if(!reg.test(email)){
            alert('邮箱格式有误')
            return
        }else{
            $("#sendEmail").val('60s')
            var time=setInterval(time,1000)
            $("#sendEmail").css('pointer-events','none')  //zhi hui
        }
        function  time() {
            var t =$("#sendEmail").val()
            var t=parseInt(t)
            if(t <= 0){
                $("#sendEmail").val('发送邮箱')
                clearInterval(time)
                $("#sendEmail").css('pointer-events','auto')
            }else{
                t=t-1
                t= $("#sendEmail").val(t+'s')
                $("#sendEmail").css('pointer-events','none')
            }
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $.post(
            "{{url('/regEmailSendCode')}}",
            {email:email},
            function (res) {
                if(res.code == 0){
                    alert(res.msg)
                }
            }
        ),'json'
    })

    $(document).on('click','#regEmail',function () {
        var name = $("#e_user_name").val()
        if(!name){
            alert('请输入用户名')
            return
        }
        $.get(
            "{{url('/onlyName')}}",
            {user_name:name},
            function (res) {
                if(res.code == 500){
                    alert(res.msg)
                    return
                }
            }
        ),'json'
        var pwd = $("#e_user_pwd").val()
        if(!pwd){
            alert('请输入密码')
            return
        }
        if(pwd.length<6){
            alert('密码长度不够')
            return;
        }
        var pwds = $("#e_user_pwds").val()
        if(pwd != pwds){
            alert('密码不一致')
            return;
        }
        var email = $("#e_user_email").val()
        if(!email){
            alert('请输入邮箱')
            return
        }
        var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
        if(!reg.test(email)){
            alert('邮箱格式有误')
            return
        }
        var code = $("#email_code").val()
        if(!code){
            alert('请输入验证码')
            return
        }
        var box = $('#Ebox').is(":checked")
        if(box==false){
            alert('请同意用户协议！')
            return
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $.post(
            "{{url('/regEmail')}}",
            {user_name:name,user_pwd1:pwd,user_pwd2:pwds,user_email:email,email_code:code},
            function (res) {
                if(res.code == 0){
                    location.href='/login'
                }else{
                    alert(res.msg)
                }
            }
        ),'json'
    })


    $("input[name='user_name']").blur(function () {
        var user_name=$(this).val();
        $(this).next().remove();
        if(!user_name){
            $(this).after("<p style='color: red'>请输入用户名</p>")
            return;
        }
    })
    $("input[name='user_pwd']").blur(function () {
        var user_pwd=$(this).val();
        $(this).next().remove();
        if(!user_pwd){
            $(this).after("<p style='color: red'>请输入密码</p>")
            return;
        }
    })
    $("input[name='user_pwds']").blur(function () {
        var user_pwds=$(this).val();
        var user_pwd=$("input[name='user_pwd']").val()
        $(this).next().remove();
        if(user_pwd != user_pwds){
            $(this).after("<p style='color: red'>密码不一致</p>")
            return;
        }
    })
    //邮箱密码
    $("input[name='user_pwd1']").blur(function () {
        var user_pwd=$(this).val();
        $(this).next().remove();
        if(!user_pwd){
            $(this).after("<p style='color: red'>请输入密码</p>")
            return;
        }
    })
    $("input[name='user_pwd2']").blur(function () {
        var user_pwds=$(this).val();
        var user_pwd=$("input[name='user_pwd1']").val()
        $(this).next().remove();
        if(user_pwd != user_pwds){
            $(this).after("<p style='color: red'>密码不一致</p>")
            return;
        }
    })

</script>
