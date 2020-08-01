@extends('admin.layout')
@section('title', 'sku列表')
@section('content')

    <div class="row J_mainContent" id="content-main">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>商品管理 <small>sku列表</small></h5>
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
                                        <input type="text" placeholder="商品名称" id="goods_name" name="goods_name"  class="form-control">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button" id="souch" >搜索</button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                            <div id="ajax">
                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                                <thead>
                                <tr>
                                    <th data-toggle="true">商品名称</th>
                                    <th data-hide="all">属性</th>
                                    <th data-hide="all">sku库存</th>
                                    <th data-hide="all">货号</th>
                                    <th data-hide="all">添加时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $v)
                                <tr>
                                    <td>{{$v['goods_name']}}</td>
                                    <td>{{$v['attr_value']}}</td>
                                    <td>{{$v['prorduct_num']}}</td>
                                    <td>{{$v['prorduct_sn']}}</td>
                                    <td>{{date('Y-m-d H:i:s',$v['prorduct_time'])}}</td>
                                    <td>
                                        <a href="javascript:;"><b style="color: blue">
                                            <i id="del" prorduct_id="{{$v['prorduct_id']}}" class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                                        </b></a> &nbsp;
                                        <a href="javascript:;"><b style="color: red">
                                            <i id="upd" prorduct_id="{{$v['prorduct_id']}}" class="glyphicon glyphicon-heart" aria-hidden="true"></i>
                                        </b></a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="5">
                                        <ul class="pagination pull-right">  {{$res->appends($query)->links()}}</ul>
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
            var goods_name=$("#goods_name").val();
            $.get(
                "/admin/goodsSku/souch/",
                {goods_name:goods_name},
                function(res){
                    $("tbody").html(res);
                }
            )
        })

        $(document).on('click','#del',function () {
            var id = $(this).attr('prorduct_id')
            $.get(
                "{{url('admin/goodsSku/del')}}",
                {id:id},
                function (res) {
                    if(res.code == 0 ){
                        var url = "{{url('admin/goodsSku/index')}}"
                        location.href=url
                    }
                }
            ),'json'
        })

        $(document).on('click','#upd',function () {
            var id = $(this).attr('prorduct_id')
            if(confirm('确定修改吗？')){
                location.href='edit?id='+id
            }
        })
    </script>


@endsection
