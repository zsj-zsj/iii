@extends('admin.layout')
@section('title', '商品修改')
@section('content')

    <script type="text/javascript" charset="utf-8" src="/style/adminStyle/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/style/adminStyle/ueditor/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="/style/adminStyle/ueditor/lang/zh-cn/zh-cn.js"></script>
    <div class="row J_mainContent" id="content-main">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>商品管理 <small>商品修改</small></h5>
                            <div class="ibox-tools">
                                <a class="close-link">
                                    🐕
                                </a>
                            </div>
                        </div>
                        <ul class="nav nav-tabs">
                            <li role="presentation" class="active"><a href="javascript:;" name="basic">修改商品基本信息</a></li>
                            <li role="presentation"><a href="javascript:;" name="detail">修改商品详情</a></li>
                        </ul> <br>
                            <form id="form"  method="post" enctype="multipart/form-data" class="form-horizontal">
{{--                                基本信息--}}
                                <input type="hidden" name="goods_id" value="{{$data->goods_id}}">
                                <div class="div_basic div_from">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">商品名称</label>
                                        <div class="col-sm-8">
                                            <input type="text" value="{{$data->goods_name}}" name="goods_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">分类</label>
                                        <div class="col-sm-3">
                                            <select name="cate_id" class="form-control" id="">
                                                @foreach($cate as $v)
                                                    <option value="{{$v->cate_id}}" {{$data->cate_id==$v->cate_id ? 'selected' : ''}}> {{str_repeat('-',$v->level*5)}}{{$v->cate_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">品牌</label>
                                        <div class="col-sm-3">
                                            <select name="brand_id" class="form-control" id="">
                                                @foreach($brand as $v)
                                                    <option value="{{$v->brand_id}}" {{$data->brand_id==$v->brand_id ? 'selected' : ''}}>{{$v->brand_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">商品货号</label>
                                        <div class="col-sm-8">
                                            <input type="text" value="{{$data->goods_sn}}" name="goods_sn" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">基本价格</label>
                                        <div class="col-sm-8">
                                            <input type="text" value="{{$data->goods_price}}" name="goods_price" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">商品基本库存</label>
                                        <div class="col-sm-8">
                                            <input type="text" value="{{$data->goods_num}}" name="goods_num" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">商品图片</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="goods_img" id = "file">
                                            <img src="{{env('APP_URL')}}/app/{{$data->goods_img}}" width="100px" height="100px" alt="">
                                        </div>
                                    </div>
                                </div>
{{--                                详情--}}
                            <div class="div_detail div_from" style="display:none">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">商品详情</label>
                                    <div class="col-sm-8">
                                        <script id="editor" name="goods_desc">{{$data->goods_desc}}</script>
                                    </div>
                                </div>
                            </div>

                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary" id="but" type="button">修改</button>
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
                url : "{{url('admin/goods/upd')}}",
                dataType : "json",
                processData: false,
                contentType: false,
                success : function(res){
                    if(res.code == 0 ){
                        var url = "{{url('admin/goods/index')}}"
                        location.href=url
                    }
                }
            })
        })

    </script>
    <script>
        var ue = UE.getEditor('editor');
    </script>

@endsection
