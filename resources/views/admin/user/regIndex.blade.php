@extends('admin.layout')
@section('title', '用户列表')
@section('content')

    <div class="row J_mainContent" id="content-main">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>用户管理<small>用户列表</small></h5>
                            <div class="ibox-tools">
                                <a class="close-link">
                                    🐕
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div id="ajax">
                                <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                                    <thead>
                                    <tr>
                                        <th data-hide="all">用户名</th>
                                        <th data-hide="all">角色</th>
                                        <th data-hide="all">修改密码</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $v)
                                        <tr>
                                            <td>{{$v['user_name']}}</td>
                                            <td>{{$v['role_name']}}</td>
                                            <td><a href="{{url('admin/regPass')}}?user_id={{$v['user_id']}}">点击修改</a></td>
                                            <td>
                                                <a href="javascript:;"><b style="color: blue">
                                                        <i id="del" user_id="{{$v['user_id']}}" class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                                                    </b></a> &nbsp;
                                                <a href="javascript:;"><b style="color: red">
                                                        <i id="upd" user_id="{{$v['user_id']}}" class="glyphicon glyphicon-heart" aria-hidden="true"></i>
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
            var user_id = $(this).attr('user_id')
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                type: "post",
                data: {user_id:user_id},
                url: "{{url('admin/regDel')}}",
                dataType: 'json',
                success:function (res) {
                    if(res.code == 0){
                        location.href='/admin/regIndex'
                    }
                }
            })
        })

        $(document).on('click','#upd',function () {
            var id = $(this).attr("user_id")
            if(confirm('确认修改吗?')){
                location.href='/admin/regEdit?id='+id
            }
        })

    </script>


@endsection
