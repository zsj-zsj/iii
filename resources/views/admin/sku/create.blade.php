@extends('admin.layout')
@section('title', 'sku添加')
@section('content')

    <div class="row J_mainContent" id="content-main">
        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>商品管理 <small>sku添加</small></h5>
                            <div class="ibox-tools">
                                <a class="close-link">
                                    🐕
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form id="form"  method="post" class="form-horizontal">
                                <input type="hidden" value="{{{$data->goods_id}}}" name="goods_id">
                                <div class="form-group">
                                    商品名称： <b style="color: red">{{$data->goods_name}}</b>
                                    商品货号： <b style="color: red">{{$data->goods_sn}}</b>
                                </div>
                                <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                                    <thead>
                                        <tr>
                                            @foreach($newGoodsAttr as $k=>$v)
                                                <th data-hide="all">{{$k}}</th>
                                            @endforeach
                                                <th data-toggle="true">sku货号</th>
                                                <th data-hide="all">sku库存</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @foreach($newGoodsAttr as $v)
                                                <td >
                                                    <select name="goods_attr_id[]" class="form-control" id="">
                                                        <option value="">选择属性</option>
                                                        @foreach($v as $key => $val)
                                                            <option value="{{$val['goods_attr_id']}}">{{$val['attr_value']}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            @endforeach
                                            <td><input type="text" class="form-control" name="prorduct_sn[]" id="inputDisabled" placeholder="自动生成" value="" ></td>
                                            <td><input type="text" class="form-control" name="prorduct_num[]" value="1" ></td>
                                            <td><input type="button" class="addTr" value=" + "></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary" id="but" type="button">添加</button>
                                    </div>
                                </div>
                            </form>
                            <a href="{{url('admin/goodsSku/index')}}" class="btn btn-warning">列表</a>
                            <a href="{{url('admin/goodsSku/goodSouch')}}" class="btn btn-warning">稍后自行添加</a>
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

        $(document).on('click','.addTr',function () {
            var value = $(this).val()
            if(value == ' + ' ){
                var tr = $(this).parent().parent()
                var clone = tr.clone()
                $(this).val(' - ')
                tr.after(clone)
            }else{
                if(confirm('确定删除吗?')){
                    $(this).parent().parent().remove()
                }
            }
        })

        $(document).on('click','#but',function () {
            var data = $("#form").serialize()
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.post(
                "{{url('admin/goodsSku/store')}}",
                data,
                function (res) {
                    var url = "{{url('admin/goodsSku/index')}}"
                    if(res.code == 0){
                        location.href=url
                    }
                }
            ),'json'
        })

    </script>

@endsection
