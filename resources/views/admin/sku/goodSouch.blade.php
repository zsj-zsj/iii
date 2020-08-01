@extends('admin.layout')
@section('title', '选择商品')
@section('content')
    <style>
        #iiiii{
            margin-left: 200px;
        }
        #oooo{
            margin-left: 500px;
        }
    </style>

    <div class="row J_mainContent" id="content-main">
        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>商品管理 <small>查找商品</small></h5>
                            <div class="ibox-tools">
                                <a class="close-link">
                                    🐕
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <h2 id="oooo">添加sku库存</h2>
                            <form id="form"  method="post"  class="form-horizontal">
                                <div class="col-lg-5" id="iiiii">
                                    <div class="input-group">
                                        <input type="text" placeholder="商品名称" id="goods_name"  name="goods_name"  class="form-control">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button" id="souch" >搜索</button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                            <a href="{{url('admin/goods/index')}}" class="btn btn-warning">商品列表</a>
                            <a href="{{url('admin/goodsSku/getGoods')}}" class="btn btn-warning">查看商品</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).on('click','#souch',function () {
            var goods_name = $("input[name='goods_name']").val()
            $.ajax({
                data : {goods_name:goods_name},
                url : "{{url('/admin/goodsSku/goodSouchD')}}",
                dataType : "json",
                success:function (res) {
                    if(res.code == 500 ){
                        alert(res.msg)
                    }else {
                        location.href='create?id='+res.goods_id
                    }
                }
            })
        })
    </script>

@endsection
