@extends('admin.layout')

@section('title', '角色权限修改')

@section('content')
    <div class="row J_mainContent" id="content-main">
        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>用户管理 <small>角色权限修改</small></h5>
                            <div class="ibox-tools">
                                <a class="close-link">
                                    🐕
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form id="form"  method="post" class="form-horizontal">
                                <input type="hidden" value="{{$rp->rp_id}}" name="rp_id">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">选择角色</label>
                                    <div class="col-sm-3">
                                        <select name="role_id" class="form-control" id="role_id">
                                            <option value="">请选择</option>
                                            @foreach($role as $v)
                                                <option value="{{$v->role_id}}" {{$rp->role_id == $v->role_id ? 'selected' : ''}}>{{$v->role_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">选择权限</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="permission_id">
                                            @foreach ($perm as $v)
                                                <option  value="{{$v->permission_id}}" {{$rp->permission_id==$v->permission_id ? 'selected' : ''}} >{{$v->permission_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary" id="but" type="button">添加</button>
                                    </div>
                                </div>
                            </form>
                            <a href="{{url('admin/rolePerm/index')}}" class="btn btn-warning">列表</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).on('click','#but',function () {
            var rp_id = $("input[name='rp_id']").val()
            var role_id = $("select[name='role_id']").val()
            var permission_id = $("select[name='permission_id']").val()
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                type : "post",
                data : {rp_id:rp_id,role_id:role_id,permission_id:permission_id},
                url : "{{url('admin/rolePerm/upd')}}",
                dataType : "json",
                success:function (res) {
                    if(res.code == 0){
                        var url = "{{url('/admin/rolePerm/index')}}"
                        location.href=url
                    }
                }
            })
        })

    </script>

@endsection
