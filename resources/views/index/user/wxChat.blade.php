<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>WechatLogin</title>
    <meta name="author" content="DeathGhost"/>
    <link rel="stylesheet" type="text/css" href="/style/adminStyle/user/css/styles.css" tppabs="/style/adminStyle/user/css/styles.css"/>
    <script src="/style/adminStyle/user/js/jquery.js"></script>
    <script src="/style/adminStyle/user/js/verificationNumbers.js" tppabs="/style/adminStyle/user/js/verificationNumbers.js"></script>
    <script src="/style/adminStyle/user/js/Particleground.js" tppabs="/style/adminStyle/user/js/Particleground.js"></script>
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
<form method="post" id="form" >
    @csrf
    <dl class="admin_login">
        <dt>
            <strong>微信扫码登录</strong>
        </dt>
            <img src="http://qr.topscan.com/api.php?text={{$wxChatImg}}">
    </dl>
</form>
</body>
</html>

<script>
    var t = setInterval("check();",2000);
    //setTimeOut
    var status = "{{$status}}";
    function check(){
        //js轮询
        $.ajax({
            url:"{{url('/wxChatStatus')}}",
            dataType:"json",
            data:{status:status},
            success:function(res){
                //返回提示
                if(res.code == 1){
                    //关闭定时器
                    clearInterval(t);
                    //扫码登陆成功
                    alert(res.msg);
                    location.href="{{url('/')}}";
                }
            }
        })
    }
</script>
