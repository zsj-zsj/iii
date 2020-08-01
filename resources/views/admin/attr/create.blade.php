@extends('admin.layout')
@section('title', '属性添加')
@section('content')

<div class="row J_mainContent" id="content-main">
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>商品管理 <small>属性添加</small></h5>
                        <div class="ibox-tools">
                            <a class="close-link">
                                🐕
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form id="form"  method="post" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">属性名称</label>
                                <div class="col-sm-8">
                                    <input type="text" name="attr_name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">所属类型</label>
                                <div class="col-sm-3">
                                    <select name="type_id" class="form-control" id="">
                                        <option value="0">请选择</option>
                                        @foreach($type as $v)
                                            <option value="{{$v->type_id}}"> {{$v->type_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">选择参数</label>
                                <div class="col-sm-5">
                                    <input type="radio" name="attr_type"  value="1">规格
                                    <input type="radio" name="attr_type"  value="2">参数
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" id="but" type="button">添加</button>
                                </div>
                            </div>
                        </form>
                        <a href="{{url('admin/attr/index')}}" class="btn btn-warning">列表</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        $(document).on('click','#but',function () {
            var data = $("#form").serialize()
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.post(
                "{{url('admin/attr/story')}}",
                data,
                function(res){
                    if(res.code==0){
                        var url = "{{url('admin/attr/index')}}"
                        location.href=url
                    }
                }
            ),'json'
        })

    </script>

@endsection
