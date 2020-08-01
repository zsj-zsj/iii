<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WxChatLogin</title>
</head>

<style>

</style>
<body>
<table aligin="center">
    <h1 style="color: red">欢迎使用扫码登录</h1>
    <img src="http://qr.topscan.com/api.php?text={{$wxChatImg}}">
</table>
</body>
</html>

<script src="/style/adminStyle/js/jq.js"></script>
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
