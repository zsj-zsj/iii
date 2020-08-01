@extends('admin.layout')
@section('title', 'sku修改')
@section('content')

    <div class="row J_mainContent" id="content-main">
        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>商品管理 <small>sku修改</small></h5>
                            <div class="ibox-tools">
                                <a class="close-link">
                                    🐕
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form id="form"  method="post" class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">商品名称</label>
                                    <div class="col-sm-8">
                                        <input type="text" style="color: red" id="inputDisabled" value="{{$data['goods_name']}}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">商品属性</label>
                                    <div class="col-sm-8">
                                        <input type="text" style="color: blue" id="inputs" value="{{$data['attr_value']}}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">sku库存</label>
                                    <div class="col-sm-8">
                                        <input type="hidden" value="{{$data['prorduct_id']}}" name="prorduct_id">
                                        <input type="text" name="prorduct_num" value="{{$data['prorduct_num']}}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">sku货号</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="prorduct_sn" value="{{$data['prorduct_sn']}}" class="form-control">
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary" id="but" type="button">修改</button>
                                    </div>
                                </div>
                            </form>
                            <a href="{{url('admin/goodsSku/index')}}" class="btn btn-warning">列表</a>
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
            $("#inputs").attr("disabled","false");
        })
        $(document).on('click','#but',function () {
            var data = $("#form").serialize()
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.post(
                "{{url('admin/goodsSku/upd')}}",
                data,
                function(res){
                    if(res.code==0){
                        var url = "{{url('admin/goodsSku/index')}}"
                        location.href=url
                    }
                }
            ),'json'
        })

    </script>

@endsection
