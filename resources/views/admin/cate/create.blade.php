@extends('admin.layout')

@section('title', '品牌添加')

@section('content')
    <div class="row J_mainContent" id="content-main">
        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>商品管理 <small>分类添加</small></h5>
                            <div class="ibox-tools">
                                <a class="close-link">
                                    🐕
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form id="form"  method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">分类名称</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="cate_name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">选择分类</label>
                                    <div class="col-sm-3">
                                        <select name="parent_id" class="form-control" id="">
                                            <option value="0">请选择</option>
                                            @foreach($cate as $v)
                                                <option value="{{$v->cate_id}}"> {{str_repeat('-',$v->level*5)}}{{$v->cate_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary" id="but" type="button">添加</button>
                                    </div>
                                </div>
                            </form>
                            <a href="{{url('admin/cate/index')}}" class="btn btn-warning">列表</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).on('click','#but',function () {
            var name = $("input[name='cate_name']").val()
            var p_id = $("select[name='parent_id']").val()
            var data = {
                cate_name:name,parent_id:p_id
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                type : "post",
                data : data,
                url : "{{url('admin/cate/story')}}",
                dataType : "json",
                success:function (res) {
                    if(res.code == 0){
                        var url = "{{url('/admin/cate/index')}}"
                        location.href=url
                    }
                }
            })
        })
    </script>

@endsection
