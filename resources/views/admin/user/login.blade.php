<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>后台管理员登录</title>
    <meta name="author" content="DeathGhost"/>
    <link rel="stylesheet" type="text/css" href="/style/adminStyle/user/css/styles.css" tppabs="/style/adminStyle/user/css/styles.css"/>
    <script src="/style/adminStyle/user/js/jquery.js"></script>
    <script src="/style/adminStyle/user/js/verificationNumbers.js" tppabs="/style/adminStyle/user/js/verificationNumbers.js"></script>
    <script src="/style/adminStyle/user/js/Particleground.js" tppabs="/style/adminStyle/user/js/Particleground.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/style/adminStyle/css/font-awesome.css" rel="stylesheet">
    <style>
        body {
            height: 100%;
            background: #16a085;
            overflow: hidden;
        }

        canvas {
            z-index: -1;
            position: absolute;
        }
         #eye{
             position: absolute;
             left: 90%;
             top : 15px;
             margin-left: -15%;
             /*color: #B2B2B2;*/
         }
    </style>

    <script>
        $(document).ready(function () {
            //粒子背景特效
            $('body').particleground({
                dotColor: '#5cbdaa',
                lineColor: '#5cbdaa'
            });
        });
    </script>
</head>
<body>
<form method="post" id="form" >
    @csrf
    <dl class="admin_login">
        <dt>
            <strong>后台登陆管理系统</strong>
            <em>The Background of Landing</em>
        </dt>
        <dd class="user_icon">
            <input type="text" name="user_name" placeholder="请输入账号" class="login_txtbx"/>
        </dd>
        <dd class="pwd_icon">
            <div>
                <span style="cursor:pointer;"><i class="fa fa-eye"  id="eye"></i></span>
            </div>
            <input type="password" id="pass" name="user_pwd" placeholder="请输入密码" class="login_txtbx"/>
        </dd>

        <dd>
            <input type="button" id="but" value="立即登陆" class="submit_btn"/>
        </dd>
        <dd>
            <p>welcome</p>
        </dd>
    </dl>
</form>
</body>
</html>

<script>
    $(function(){
        $("#eye").mousedown(function(){
            $("#pass").attr("type", "text");
        });
        $("#eye").mouseup(function(){
            $("#pass").attr("type", "password");
        });
    });
    $(document).on('click','#but',function () {
        var data = $("#form").serialize()
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $.post(
            "{{url('/adminLoginDo')}}",
            data,
            function (res) {
                if(res.code ==0 ){
                    location.href='/admin/index'
                }else{
                    alert(res.msg)
                }
            }
        ),'json'
    })
</script>
