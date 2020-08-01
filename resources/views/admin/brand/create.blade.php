@extends('admin.layout')

@section('title', '品牌添加')

@section('content')
<div class="row J_mainContent" id="content-main">
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>商品管理 <small>品牌添加</small></h5>
                        <div class="ibox-tools">
                            <a class="close-link">
                                🐕
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form id="form"  method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">品牌名称</label>
                                <div class="col-sm-8">
                                    <input type="text" name="brand_name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">品牌网址</label>
                                <div class="col-sm-8">
                                    <input type="text" name="brand_url" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">是否显示</label>
                                <div class="col-sm-5">
                                    <input type="radio" name="brand_show" checked  value="1">是
                                    <input type="radio" name="brand_show"  value="2">否
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">品牌图片</label>
                                <div class="col-sm-10">
                                    <input type="file" name="brand_img" id = "file">
                                    <img src="" id="img"  width="200px" height="200px" alt="">
                                </div>
                            </div>


                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" id="but" type="button">添加</button>
                                </div>
                            </div>
                        </form>
                        <a href="{{url('admin/brand/index')}}" class="btn btn-warning">列表</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
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
                url : "{{url('admin/brand/story')}}",
                dataType : "json",
                processData: false,
                contentType: false,
                success : function(res){
                    if(res.code == 0 ){
                        var url = "{{url('admin/brand/index')}}"
                        location.href=url
                    }
                }
            })
        })

    </script>

@endsection
