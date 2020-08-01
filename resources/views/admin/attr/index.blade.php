@extends('admin.layout')
@section('title', '属性列表')
@section('content')

    <div class="row J_mainContent" id="content-main">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>商品管理 <small>属性列表</small></h5>
                            <div class="ibox-tools">
                                <a class="close-link">
                                    🐕
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form id="myform">
                                <div class="col-lg-3">
                                    <div class="input-group">
                                        <select id="type_id" class="form-control">
                                            <option value="">商品类型</option>
                                            @foreach($type as $v)
                                                <option value="{{$v->type_id}}">{{$v->type_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <a href="{{url('admin/attr/create')}}" class="btn btn-warning">添加</a>
                            <div id="ajax">
                                <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                                    <thead>
                                    <tr  >
                                        <th data-hide="all">属性名称</th>
                                        <th data-toggle="true">所属类型</th>
                                        <th data-hide="all">添加时间</th>
                                        <th data-hide="all">参数</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $v)
                                        <tr>
                                            <td >{{$v->attr_name}}</td>
                                            <td >{{$v->type_name}}</td>
                                            <td>{{date('Y-m-d H:i:s',$v->attr_time)}}</td>
                                            <td >{{$v->attr_type==1 ? '规格' : '可选'}}</td>
                                            <td>
                                                <a href="javascript:;"><b style="color: blue">
                                                        <i id="del" attr_id="{{$v->attr_id}}" class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                                                    </b></a> &nbsp;
                                                <a href="javascript:;"><b style="color: red">
                                                        <i id="upd" attr_id="{{$v->attr_id}}" class="glyphicon glyphicon-heart" aria-hidden="true"></i>
                                                    </b></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="5">
                                            <ul class="pagination pull-right">  {{$data->appends($query)->links()}}</ul>
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
        $(document).on('change','#myform',function(){
            var type_id=$("#type_id").val();
            $.get(
                "/admin/attr/souch",
                {type_id:type_id},
                function(res){
                    $("tbody").html(res);
                }
            )
        })
        $(document).on('click','.pagination a',function(){
            var url=$(this).attr('href')
            $.get(url,function(msg){
                $('#ajax').html(msg)
            })
            return false
        })
        $(document).on('click','#del',function () {
            var attr_id = $(this).attr('attr_id')
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            if(confirm('确认删除吗?')) {
                $.ajax({
                    type: "post",
                    data: {attr_id: attr_id},
                    url: "{{url('admin/attr/del')}}",
                    dataType: 'json',
                    success: function (res) {
                        if (res.code == 0) {
                            location.href = '/admin/attr/index'
                        }
                    }
                })
            }
        })

        $(document).on('click','#upd',function () {
            var id = $(this).attr("attr_id")
            if(confirm('确认修改吗?')){
                location.href='/admin/attr/edit?id='+id
            }
        })

    </script>


@endsection
