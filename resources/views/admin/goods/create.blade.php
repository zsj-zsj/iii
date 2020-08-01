@extends('admin.layout')
@section('title', '商品添加')
@section('content')
    <style>
        .you{
            margin-left: 150px ;
        }
    </style>
    <script type="text/javascript" charset="utf-8" src="/style/adminStyle/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/style/adminStyle/ueditor/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="/style/adminStyle/ueditor/lang/zh-cn/zh-cn.js"></script>
    <div class="row J_mainContent" id="content-main">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>商品管理 <small>商品添加</small></h5>
                            <div class="ibox-tools">
                                <a class="close-link">
                                    🐕
                                </a>
                            </div>
                        </div>
                        <ul class="nav nav-tabs">
                            <li role="presentation" class="active"><a href="javascript:;" name="basic">商品基本信息</a></li>
                            <li role="presentation"><a href="javascript:;" name="attr">商品属性</a></li>
                            <li role="presentation"><a href="javascript:;" name="detail">商品详情</a></li>
                        </ul> <br>
                            <form id="form"  method="post" enctype="multipart/form-data" class="form-horizontal">
{{--                                基本信息--}}
                                <div class="div_basic div_from">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">商品名称</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="goods_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">选择分类</label>
                                        <div class="col-sm-3">
                                            <select name="cate_id" class="form-control" id="">
                                                <option value="">选择分类</option>
                                                @foreach($cate as $v)
                                                    <option value="{{$v->cate_id}}"> {{str_repeat('-',$v->level*5)}}{{$v->cate_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">选择品牌</label>
                                        <div class="col-sm-3">
                                            <select name="brand_id" class="form-control" id="">
                                                <option value="">选择品牌</option>
                                                @foreach($brand as $v)
                                                    <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">商品货号</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="inputDisabled" placeholder="自动生成" name="goods_sn" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">基本价格</label>
                                        <div class="col-sm-8">
                                            <input type="text"  name="goods_price" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">商品基本库存</label>
                                        <div class="col-sm-8">
                                            <input type="text"  name="goods_num" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">商品图片</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="goods_img" id = "file">
                                            <img src="" id="img"  width="200px" height="200px" alt="">
                                        </div>
                                    </div>
                                </div>
{{--                                商品属性--}}
                            <div class="div_attr div_from" style="display:none">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">选择类型</label>
                                    <div class="col-sm-3">
                                        <select name="type_id" class="form-control" >
                                            <option value="">选择类型</option>
                                            @foreach($type as $v)
                                            <option value="{{$v->type_id}}">{{$v->type_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <table class="you">
                                    <tbody id="attrTable">
                                    </tbody>
                                </table>
                            </div>
{{--                                详情--}}
                            <div class="div_detail div_from" style="display:none">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">商品详情</label>
                                    <div class="col-sm-8">
                                        <script id="editor" name="goods_desc"></script>
                                    </div>
                                </div>
                            </div>

                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary" id="but" type="button">添加</button>
                                    </div>
                                </div>
                            </form>
                            <a href="{{url('admin/goods/index')}}" class="btn btn-warning">列表</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(".nav-tabs a").on('click',function(){
            $(this).parent().siblings('li').removeClass('active')
            $(this).parent().addClass('active')
            var name = $(this).attr('name')
            $(".div_from").hide()
            $(".div_"+name).show()
        })
        $(function () {
            $("#inputDisabled").attr("disabled","false");
        })

        $("[name='type_id']").on('change',function () {
            var type_id = $(this).val()
            $.ajax({
                url : "{{url('admin/goods/getAttr')}}",
                data : {type_id:type_id},
                dataType: "json",
                success : function (res) {
                    $("#attrTable").empty()
                    $.each(res,function(i,v){
                        if(v.attr_type == 2){
                            //可选
                            var tr ='<tr>\
                                        <td> <a href="javascript:;" class="addRow">[+]</a>'+v.attr_name+'</td>\
                                        <td>\
                                            <input type="hidden" name="goods_attr_id[]" value="'+v.attr_id+'">\
                                            <input name="attr_value[]"  type="text" value="" size="20">\
                                            属性价格： <input type="text" name="attr_price[]" value="" size="5" maxlength="10">\
                                         </td>\
                                    </tr>'
                        }else{
                            var tr = '<tr>\
                                            <td>'+v.attr_name+'</td>\
                                         <td>\
                                            <input type="hidden" name="attr_id_list[]" value="'+v.attr_id+'">\
                                            <input name="attr_value[]" type="text" value="" size="20">\
                                            <input type="text" name="attr_price[]" size="5" value="0">\
                                        </td>\
                                    </tr>'
                        }
                        $("#attrTable").append(tr);
                    })
                }
            })
        })

        $(document).on('click','.addRow',function () {
            var value = $(this).html()
            if(value== '[+]'){
                $(this).html('[-]')
                var tr =$(this).parent().parent()
                var clone = tr.clone()
                $(this).html('[+]')
                tr.after(clone)
            }else{
                if(confirm('确定删除吗?')){
                    $(this).parent().parent().remove()
                }
            }
        })

        $(document).on('click','#but',function(){
            var data = new FormData($("#form")[0])
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                type : "post",
                data : data,
                url : "{{url('admin/goods/story')}}",
                dataType : "json",
                processData: false,
                contentType: false,
                success : function(res){
                    if(res.code == 0 ){
                        location.href=res.url
                    }
                }
            })
        })

    </script>
    <script>
        var ue = UE.getEditor('editor');
    </script>

@endsection
