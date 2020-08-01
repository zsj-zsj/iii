@extends('admin.layout')

@section('title', '修改密码')

@section('content')
    <div class="row J_mainContent" id="content-main">
        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>用户管理 <small>修改密码</small></h5>
                            <div class="ibox-tools">
                                <a class="close-link">
                                    🐕
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form id="form"  method="post" class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">用户</label>
                                    <div class="col-sm-8">
                                        <h2 style="color: red">{{$data->user_name}}</h2>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">请输入旧密码</label>
                                    <div class="col-sm-8">
                                        <input type="hidden" value="{{$data->user_id}}" name="user_id">
                                        <input type="password" name="user_pwd" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">新密码</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="newpwd1" class="form-control">
                                    </div>
                                </div><div class="form-group">
                                    <label class="col-sm-2 control-label">确认新密码</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="newpwd2" class="form-control">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary" id="but" type="button">修改</button>
                                    </div>
                                </div>
                            </form>
                            <a href="{{url('admin/regIndex')}}" class="btn btn-warning">列表</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).on('click','#but',function () {
            var data = $("#form").serialize()
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.post(
                "{{url('/admin/regPassDo')}}",
                data,
                function (res) {
                    if(res.code ==0 ){
                        location.href='/admin/regIndex'
                    }else{
                        alert(res.msg)
                    }
                }
            ),'json'
        })
    </script>

@endsection
