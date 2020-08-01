@extends('admin.layout')
@section('title', '角色权限添加')
@section('content')

    <div class="row J_mainContent" id="content-main">
        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>用户管理 <small>角色权限添加</small></h5>
                            <div class="ibox-tools">
                                <a class="close-link">
                                    🐕
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form id="form"  method="post" class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">选择角色</label>
                                    <div class="col-sm-3">
                                        <select name="role_id" class="form-control" id="role_id">
                                            <option value="">请选择</option>
                                            @foreach($role as $v)
                                                <option value="{{$v->role_id}}">{{$v->role_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">选择权限</label>
                                    <div class="col-sm-8">
                                        @foreach($perm as $v)
                                            {{$v->permission_name}}<input type="checkbox" name="permission_id[]" value="{{$v->permission_id}}" >
                                            &nbsp; &nbsp;
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">全选<input type="checkbox" id="all"></label>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">反选<input type="checkbox" id="fx"></label>
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
        //全选
        $("#all").click(function(){
            var all= $(this).prop('checked');
            $('input[name="permission_id[]"]').prop('checked',all)
        })

        $(document).on('click','#fx',function () {
            $('input[name="permission_id[]"]').prop('checked',function (i,v) {
                return !v
            })
        })

        $(document).on('click','#but',function(){
            var role_id = $("#role_id ").val();
            var arr=[]
            $.each($("input[name='permission_id[]']:checked"),function(){
                arr.push($(this).val())
            })
            var data={
                role_id:role_id,arr:arr
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.post(
                "{{url('admin/rolePerm/story')}}",
                data,
                function(res){
                    if(res.code == 0){
                        location.href='/admin/rolePerm/index'
                    }
                }
            ),'json'
        })

    </script>

@endsection
