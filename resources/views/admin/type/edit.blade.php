@extends('admin.layout')

@section('title', '品牌添加')

@section('content')
    <div class="row J_mainContent" id="content-main">
        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>商品管理 <small>类型修改</small></h5>
                            <div class="ibox-tools">
                                <a class="close-link">
                                    🐕
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form id="form"  method="post"  class="form-horizontal">
                                <input type="hidden" value="{{$data->type_id}}" name="type_id">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">商品类型</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="type_name" value="{{$data->type_name}}" class="form-control">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary" id="but" type="button">修改</button>
                                    </div>
                                </div>
                            </form>
                            <a href="{{url('admin/type/index')}}" class="btn btn-warning">列表</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).on('click','#but',function () {
            var name = $("input[name='type_name']").val()
            var t_id = $("input[name='type_id']").val()
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                type : "post",
                data : {type_name:name,type_id:t_id},
                url : "{{url('/admin/type/upd')}}",
                dataType : "json",
                success:function (res) {
                    if(res.code == 0){
                        var url = "{{url('/admin/type/index')}}"
                        location.href=url
                    }
                }
            })
        })
    </script>

@endsection
