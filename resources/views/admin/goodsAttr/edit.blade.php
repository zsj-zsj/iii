@extends('admin.layout')

@section('title', '分类修改')

@section('content')
    <div class="row J_mainContent" id="content-main">
        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>商品管理 <small>商品属性修改</small></h5>
                            <div class="ibox-tools">
                                <a class="close-link">
                                    🐕
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form id="form"  method="post"  class="form-horizontal">
                                @csrf
                                <input type="hidden" name="goods_attr_id" value="{{$data->goods_attr_id}}">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">商品名称</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="inputDisabled" style="color: red"  value="{{$data->goods_name}}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">属性</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="inputD" style="color: red" value="{{$data->attr_name}}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">属性值</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="attr_value"  value="{{$data->attr_value}}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">属性价格</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="attr_price" value="{{$data->attr_price}}" class="form-control">
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary" id="but" type="button">修改</button>
                                    </div>
                                </div>
                            </form>
                            <a href="{{url('admin/goodsAttr/index')}}" class="btn btn-warning">列表</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            $("#inputDisabled").attr("disabled","false");
        })
        $(function () {
            $("#inputD").attr("disabled","false");
        })

        $(document).on('click','#but',function () {
            var attr_price = $("input[name='attr_price']").val()
            var attr_value = $("input[name='attr_value']").val()
            var goods_attr_id = $("input[name='goods_attr_id']").val()
            var data = {
                goods_attr_id:goods_attr_id,attr_price:attr_price,attr_value:attr_value
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                type : "post",
                data : data,
                url : "{{url('admin/goodsAttr/upd')}}",
                dataType : "json",
                success:function (res) {
                    if(res.code == 0){
                        var url = "{{url('/admin/goodsAttr/index')}}"
                        location.href=url
                    }
                }
            })
        })
    </script>

@endsection
