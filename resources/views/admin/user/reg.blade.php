<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>后台管理员注册系统</title>
    <meta name="author" content="DeathGhost"/>
    <link rel="stylesheet" type="text/css" href="/style/adminStyle/user/css/styles.css" tppabs="/style/adminStyle/user/css/styles.css"/>
    <script src="/style/adminStyle/user/js/jquery.js"></script>
    <script src="/style/adminStyle/user/js/verificationNumbers.js" tppabs="/style/adminStyle/user/js/verificationNumbers.js"></script>
    <script src="/style/adminStyle/user/js/Particleground.js" tppabs="/style/adminStyle/user/js/Particleground.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
<form method="post" >
    @csrf
    <dl class="admin_login">
        <dt>
            <strong>管理员注册</strong>
            <em><a href="{{url('admin/index')}}">后台管理</a> </em>
        </dt>
        <dd class="user_icon">
            <input type="text" name="user_name" placeholder="用户名" class="login_txtbx"/>
        </dd>

        <dd class="pwd_icon">
            <input type="password" name="user_pwd" placeholder="密码" class="login_txtbx"/>
        </dd>
        <dd class="">
            @foreach($role as $v)
                {{$v->role_name}}<input type="checkbox" value="{{$v->role_id}}"  name="role_id" />
            @endforeach
        </dd>
        <dd>
            <input type="button" id="but" value="注册" class="submit_btn"/>
        </dd>
        <dd>
            <p>welcome</p>
        </dd>
    </dl>
</form>
</body>
</html>


<script>
    $(document).on('click','#but',function () {
        var user_name = $('input[name="user_name"]').val()
        var user_pwd = $('input[name="user_pwd"]').val()
        var arr = []
        $.each($("input[name='role_id']:checked"),function(){
            arr.push($(this).val())
        })
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $.ajax({
            type : "post",
            data : {user_name:user_name,user_pwd:user_pwd,role_id:arr},
            url : "{{url('/admin/doreg')}}",
            dataType : "json",
            success : function (res) {
                if(res.code == 0){
                    location.href='/admin/regIndex'
                }
            }
        })

    })
</script>

