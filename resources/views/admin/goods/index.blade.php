@extends('admin.layout')
@section('title', '商品列表')
@section('content')

    <div class="row J_mainContent" id="content-main">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>商品管理 <small>商品列表</small></h5>
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
                                        <select id="brand_id" class="form-control">
                                            <option value="">选择品牌</option>
                                            @foreach($brand as $v)
                                                <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-group">
                                        <select id="cate_id" class="form-control">
                                            <option value="">选择分类</option>
                                            @foreach($cate as $v)
                                                <option value="{{$v->cate_id}}"> {{str_repeat('-',$v->level*5)}} {{$v->cate_name}}</option>
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
                            <div id="ajax">
                                <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                                    <thead>
                                    <tr  >
                                        <th data-toggle="true">商品名称</th>
                                        <th data-hide="all">属性</th>
                                        <th data-hide="all">货号</th>
                                        <th data-hide="all">分类</th>
                                        <th data-hide="all">品牌</th>
                                        <th data-hide="all">图片</th>
                                        <th data-hide="all">详情</th>
                                        <th data-hide="all">价格</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $v)
                                        <tr>
                                            <td >{{$v->goods_name}}</td>
                                            <td style="color: red" g_id="{{$v->goods_id}}"><a href="javascript:;" id="attr">查看此属性</a> </td>
                                            <td >{{$v->goods_sn}}</td>
                                            <td >{{$v->cate_name}}</td>
                                            <td >{{$v->brand_name}}</td>
                                            <td ><img src="{{env('APP_URL')}}/app/{{$v->goods_img}}" width="100px" height="100px"> </td>
                                            <td >{!!$v->goods_desc!!}</td>
                                            <td >{{$v->goods_price}}</td>
                                            <td>
                                                <a href="javascript:;"><b style="color: blue">
                                                        <i id="del" goods_id="{{$v->goods_id}}" class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                                                    </b></a> &nbsp;
                                                <a href="javascript:;"><b style="color: red">
                                                        <i id="upd" goods_id="{{$v->goods_id}}" class="glyphicon glyphicon-heart" aria-hidden="true"></i>
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
                                <a href="{{url('admin/goods/create')}}" class="btn btn-warning">添加</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).on('click','#attr',function () {
            var goods_id = $(this).parent('td').attr('g_id')
            if(confirm('点击查看')){
                location.href='/admin/goods/selectAttr?id='+goods_id
            }
        })

        $(document).on('click','.pagination a',function(){
            var url=$(this).attr('href')
            $.get(url,function(msg){
                $('#ajax').html(msg)
            })
            return false
        })

        $(document).on('click','#souch',function(){
            var brand_id=$("#brand_id").val();
            var cate_id=$("#cate_id").val();
            var goods_name=$("#goods_name").val();
            $.get(
                "/admin/goods/souch",
                {goods_name:goods_name,cate_id:cate_id,brand_id:brand_id},
                function(res){
                    $("tbody").html(res);
                }
            )
        })

        $(document).on('click','#del',function () {
            var id = $(this).attr('goods_id')
            if(confirm('删除商品即属性')) {
                $.ajax({
                    data: {goods_id: id},
                    url: "{{url('/admin/goods/del')}}",
                    dataType: "json",
                    success: function (res) {
                        console.log(res)
                        if(res.code == 0){
                            location.href="/admin/goods/index"
                        }else{
                            alert(res.msg)
                        }
                    }
                })
            }
        })

        $(document).on('click','#upd',function () {
            var id = $(this).attr('goods_id')
            if(confirm('确定修改吗？')){
                location.href='/admin/goods/edit?id='+id
            }
        })

    </script>

@endsection
