@extends('admin.layout')
@section('title', '用户修改')
@section('content')

    <div class="row J_mainContent" id="content-main">
        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>商品管理 <small>用户修改</small></h5>
                            <div class="ibox-tools">
                                <a class="close-link">
                                    🐕
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form id="form"  method="post" class="form-horizontal">
                                <input type="hidden" name="user_id" value="{{$user['user_id']}}">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">用户名</label>
                                    <div class="col-sm-8">
                                        <input type="hidden" name="user_id" value="{{$user['user_id']}}">
                                        <input type="text" name="user_name" value="{{$user['user_name']}}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">当前角色</label>
                                    <div class="col-sm-8">
                                        @foreach($role_name as  $val)
                                            {{$val['role_name']}}<input type="checkbox" name="role_id" {{$val['role_name']==$val['role_name'] ? 'checked' : ''}}>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">修改新角色</label>
                                    <div class="col-sm-8">
                                        @foreach($role as  $val)
                                            {{$val->role_name}}<input type="checkbox" name="role_id[]" value="{{$val->role_id}}" >
                                            &nbsp;
                                        @endforeach
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
            var user_name = $('input[name="user_name"]').val()
            var user_id = $('input[name="user_id"]').val()
            var arr = []
            $.each($("input[name='role_id[]']:checked"),function(){
                arr.push($(this).val())
            })

           if(arr.length>0){

           }else{
               alert('请选择角色')
               return
           }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $.ajax({
                type : "post",
                data : {user_name:user_name,user_id:user_id,role_id:arr},
                url : "{{url('/admin/regUpd')}}",
                dataType : "json",
                success : function (res) {
                    if(res.code == 0){
                        location.href='/admin/regIndex'
                    }
                }
            })

        })

    </script>

@endsection
