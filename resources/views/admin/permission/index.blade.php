@extends('admin.layout')
@section('title', '权限列表')
@section('content')

    <div class="row J_mainContent" id="content-main">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>用户管理<small>权限列表</small></h5>
                            <div class="ibox-tools">
                                <a class="close-link">
                                    🐕
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <a href="{{url('admin/perm/create')}}" class="btn btn-warning">添加</a>
                            <div id="ajax">
                                <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                                    <thead>
                                    <tr>
                                        <th data-hide="all">权限</th>
                                        <th data-hide="all">权限url</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $v)
                                        <tr>
                                            <td>{{$v->permission_name}}</td>
                                            <td>{{$v->permission_url}}</td>
                                            <td>
                                                <a href="javascript:;"><b style="color: blue">
                                                        <i id="del" permission_id="{{$v->permission_id}}" class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                                                    </b></a> &nbsp;
                                                <a href="javascript:;"><b style="color: red">
                                                        <i id="upd" permission_id="{{$v->permission_id}}" class="glyphicon glyphicon-heart" aria-hidden="true"></i>
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

        $(document).on('click','#del',function () {
            var permission_id = $(this).attr('permission_id')
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                type: "post",
                data: {id:permission_id},
                url: "{{url('admin/perm/del')}}",
                dataType: 'json',
                success:function (res) {
                    if(res.code == 0){
                        var url ="{{url('/admin/perm/index')}}"
                        location.href=url
                    }
                }
            })
        })

        $(document).on('click','#upd',function () {
            var id = $(this).attr("permission_id")
            if(confirm('确认修改吗?')){
                location.href='/admin/perm/edit?id='+id
            }
        })

    </script>


@endsection
