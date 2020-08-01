@extends('admin.layout')
@section('title', '类型列表')
@section('content')

    <div class="row J_mainContent" id="content-main">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>商品管理 <small>类型列表</small></h5>
                            <div class="ibox-tools">
                                <a class="close-link">
                                    🐕
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <a href="{{url('admin/type/create')}}" class="btn btn-warning">添加</a>
                            <div id="ajax">
                                <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                                    <thead>
                                    <tr>
                                        <th data-toggle="true">类型名称</th>
                                        <th data-hide="all">属性个数</th>
                                        <th data-hide="all">添加时间</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $v)
                                        <tr>
                                            <td >{{$v->type_name}}</td>
                                            <td >{{$v->attr_num}}</td>
                                            <td>{{date('Y-m-d H:i:s',$v->type_time)}}</td>
                                            <td>
                                                <a href="javascript:;"><b style="color: blue">
                                                        <i id="del" type_id="{{$v->type_id}}" class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                                                    </b></a> &nbsp;
                                                <a href="javascript:;"><b style="color: red">
                                                        <i id="upd" type_id="{{$v->type_id}}" class="glyphicon glyphicon-heart" aria-hidden="true"></i>
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
            var type_id = $(this).attr('type_id')
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                type: "post",
                data: {type_id:type_id},
                url: "{{url('admin/type/del')}}",
                dataType: 'json',
                success:function (res) {
                    if(res.code == 0) {
                        location.href = '/admin/type/index'
                    }else{
                        alert(res.msg)
                    }
                }
            })
        })

        $(document).on('click','#upd',function () {
            var id = $(this).attr("type_id")
            if(confirm('确认修改吗?')){
                location.href='/admin/type/edit?id='+id
            }
        })

    </script>


@endsection
