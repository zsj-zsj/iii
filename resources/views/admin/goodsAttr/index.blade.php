@extends('admin.layout')
@section('title', '商品属性列表')
@section('content')

    <div class="row J_mainContent" id="content-main">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>商品管理 <small>商品属性</small></h5>
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
                                        <select id="attr_id" class="form-control">
                                            <option value="">属性</option>
                                            @foreach($attr as $v)
                                                <option value="{{$v->attr_id}}">{{$v->attr_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-group">
                                        <input type="text" placeholder="商品名称" id="goods_name"  name="goods_name"  class="form-control">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button" id="souch" >搜索</button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                            <a href="{{url('admin/goods/index')}}" class="btn btn-warning">商品列表</a>
                            <a href="{{url('admin/goods/create')}}" class="btn btn-warning">添加</a>
                            <div id="ajax">
                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                                <thead>
                                <tr  >
                                    <th data-toggle="true">商品名称</th>
                                    <th data-hide="all">属性</th>
                                    <th data-hide="all">属性值</th>
                                    <th data-hide="all">属性价格</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $v)
                                    <tr>
                                        <td ><b style="color: red">{{$v->goods_name}}</b> </td>
                                        <td ><b style="color: red">{{$v->attr_name}}</b></td>
                                        <td ><b style="color: red">{{$v->attr_value}}</b></td>
                                        <td ><b style="color: red">{{$v->attr_price}}</b></td>
                                        <td>
                                            <a href="javascript:;"><b style="color: blue">
                                                    <i id="del" goods_attr_id="{{$v->goods_attr_id}}" class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                                                </b></a> &nbsp;
                                            <a href="javascript:;"><b style="color: red">
                                                    <i id="upd" goods_id="{{$v->goods_id}}" goods_attr_id="{{$v->goods_attr_id}}" class="glyphicon glyphicon-heart" aria-hidden="true"></i>
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
                "/admin/goodsAttr/souch",
                {goods_name:goods_name},
                function(res){
                    $("tbody").html(res);
                }
            )
        })
        $(document).on('change','#myform',function(){
            var attr_id=$("#attr_id").val();
            $.get(
                "/admin/goodsAttr/souch",
                {attr_id:attr_id},
                function(res){
                    $("tbody").html(res);
                }
            )
        })

        $(document).on('click','#del',function () {
            var id = $(this).attr('goods_attr_id')
            if(confirm('确定删除吗?')) {
                $.ajax({
                    data: {goods_attr_id: id},
                    url: "{{url('/admin/goodsAttr/del')}}",
                    dataType: "json",
                    success: function (res) {
                        if(res.code == 0){
                            location.href="/admin/goodsAttr/index"
                        }
                    }
                })
            }
        })

        $(document).on('click','#upd',function () {
            var goods_attr_id = $(this).attr('goods_attr_id')
            if(confirm('确定修改吗?')){
                location.href="/admin/goodsAttr/edit?id="+goods_attr_id
            }
        })

    </script>

@endsection

