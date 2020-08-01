@extends('admin.layout')
@section('title', '品牌列表')
@section('content')

    <div class="row J_mainContent" id="content-main">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>用户管理<small>角色列表</small></h5>
                            <div class="ibox-tools">
                                <a class="close-link">
                                    🐕
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <a href="{{url('admin/role/create')}}" class="btn btn-warning">添加</a>
                            <div id="ajax">
                                <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                                    <thead>
                                    <tr>
                                        <th data-hide="all">角色名称</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $v)
                                        <tr>
                                            <td>{{$v->role_name}}</td>
                                            <td>
                                                <a href="javascript:;"><b style="color: blue">
                                                        <i id="del" role_id="{{$v->role_id}}" class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                                                    </b></a> &nbsp;
                                                <a href="javascript:;"><b style="color: red">
                                                        <i id="upd" role_id="{{$v->role_id}}" class="glyphicon glyphicon-heart" aria-hidden="true"></i>
                                                    </b></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).on('click','#del',function () {
            var role_id = $(this).attr('role_id')
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                type: "post",
                data: {role_id:role_id},
                url: "{{url('admin/role/del')}}",
                dataType: 'json',
                success:function (res) {
                    if(res.code == 0){
                        location.href='/admin/role/index'
                    }
                }
            })
        })

        $(document).on('click','#upd',function () {
            var id = $(this).attr("role_id")
            if(confirm('确认修改吗?')){
                location.href='/admin/role/edit?id='+id
            }
        })

    </script>


@endsection
