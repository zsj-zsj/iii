@extends('admin.layout')
@section('title', '角色权限列表')
@section('content')

    <div class="row J_mainContent" id="content-main">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>用户管理<small>角色权限列表</small></h5>
                            <div class="ibox-tools">
                                <a class="close-link">
                                    🐕
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form >
                                <div class="col-lg-3">
                                    <div class="input-group">
                                        <input type="text" placeholder="角色名称" id="role_name"  name="role_name"  class="form-control">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button" id="souch" >搜索</button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                            <a href="{{url('admin/rolePerm/create')}}" class="btn btn-warning">添加</a>
                            <div id="ajax">
                                <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                                    <thead>
                                    <tr>
                                        <th data-hide="all">角色名称</th>
                                        <th data-hide="all">对应权限</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $v)
                                        <tr>
                                            <td>{{$v->role_name}}</td>
                                            <td>{{$v->permission_name}}</td>
                                            <td>
                                                <a href="javascript:;"><b style="color: blue">
                                                        <i id="del" rp_id="{{$v->rp_id}}" class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                                                    </b></a> &nbsp;
                                                <a href="javascript:;"><b style="color: red">
                                                        <i id="upd" rp_id="{{$v->rp_id}}" class="glyphicon glyphicon-heart" aria-hidden="true"></i>
                                                    </b></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="5">
                                            <ul class="pagination pull-right">  {{$data->links()}}</ul>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).on('click','.pagination a',function(){
            var url=$(this).attr('href')
            $.get(url,function(msg){
                $('#ajax').html(msg)
            })
            return false
        })

        $(document).on('click','#souch',function(){
            var role_name=$("#role_name").val();
            $.get(
                "/admin/rolePerm/souch",
                {role_name:role_name},
                function(res){
                    $("tbody").html(res);
                }
            )
        })

        $(document).on('click','#del',function () {
            var rp_id = $(this).attr('rp_id')
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                type: "post",
                data: {rp_id:rp_id},
                url: "{{url('admin/rolePerm/del')}}",
                dataType: 'json',
                success:function (res) {
                    if(res.code == 0){
                        location.href='/admin/rolePerm/index'
                    }
                }
            })
        })

        $(document).on('click','#upd',function () {
            var id = $(this).attr("rp_id")
            if(confirm('确认修改吗?')){
                location.href='/admin/rolePerm/edit?id='+id
            }
        })

    </script>


@endsection
