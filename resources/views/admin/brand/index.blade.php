@extends('admin.layout')
@section('title', '品牌列表')
@section('content')

    <div class="row J_mainContent" id="content-main">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>商品管理 <small>品牌列表</small></h5>
                            <div class="ibox-tools">
                                <a class="close-link">
                                    🐕
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form >
                                <div class="col-lg-3">
                                    <div class="input-group">
                                        <input type="text" placeholder="品牌名称" id="b_name" name="brand_name"  class="form-control">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button" id="myform" >搜索</button>
                                        </span>
                                    </div>
                                </div>
                            </form><a href="{{url('admin/brand/create')}}" class="btn btn-warning">添加</a>
                            <div id="ajax">
                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                                <thead>
                                <tr>
                                    <th data-toggle="true">品牌名称</th>
                                    <th data-hide="all">品牌网址</th>
                                    <th data-hide="all">是否显示</th>
                                    <th data-hide="all">品牌LOGO</th>
                                    <th data-hide="all">添加时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $v)
                                <tr b_id="{{$v->brand_id}}">
                                    <td brand_id="{{$v->brand_id}}" brand_name="{{$v->brand_name}}">
                                        <span class="changeName" style="cursor:pointer;">{{$v->brand_name}}</span>
                                    </td>
                                    <td>{{$v->brand_url}}</td>
                                    <td field="brand_show">
                                        <span class="changeShow" style="cursor:pointer;">{{$v->brand_show==1 ? '是' : '否'}}</span>
                                    </td>
                                    <td><img src="/app/{{$v->brand_img}}" width="50px" height="50px" alt=""> </td>
                                    <td><span class="pie"> {{date('Y-m-d H:i:s',$v->brand_time)}} </span></td>
                                    <td>
                                        <a href="javascript:;"><b style="color: blue">
                                            <i id="del" brand_id="{{$v->brand_id}}" class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                                        </b></a> &nbsp;
                                        <a href="javascript:;"><b style="color: red">
                                            <i id="upd" brand_id="{{$v->brand_id}}" class="glyphicon glyphicon-heart" aria-hidden="true"></i>
                                        </b></a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="5">
                                        <ul class="pagination pull-right">  {{$data->appends($query)->links()}}</ul>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // ajax分页
        $(document).on('click','.pagination a',function(){
            var url=$(this).attr('href')
            $.get(url,function(msg){
                $('#ajax').html(msg)
            })
            return false
        })

        //ajax搜索
        $(document).on('click','#myform',function(){
            var b_name=$("#b_name").val()
            $.get(
                "/admin/brand/souch",
                {b_name:b_name},
                function(res){
                    console.log(res)
                    $("tbody").html(res);    //标签选择器
                }
            )
        })

        $(document).on('click','#del',function () {
            var id = $(this).attr("brand_id")
            var data={
                id:id
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            if(confirm('确认删除吗?')) {
                $.ajax({
                    type: "post",
                    data: data,
                    url: "{{url('admin/brand/del')}}",
                    dataType: 'json',
                    success: function (res) {
                        if (res.code == 0) {
                            alert(res.msg)
                            var urls = "{{url('admin/brand/index')}}"
                            location.href = urls
                        }
                    }
                })
            }
        })

        $(document).on('click','#upd',function () {
            var id = $(this).attr('brand_id')
            if(confirm('确认修改吗?')){
                location.href='/admin/brand/edit?id='+id
            }
        })

        $(document).on('click','.changeShow',function () {
            var _this=$(this)
            var show=_this.text()
            if(show == '是'){
                var new_show = '否'
                var value = 2
            }else{
                var new_show='是'
                var value=1
            }
            var field = _this.parent('td').attr('field')
            var b_id = _this.parents('tr').attr('b_id')
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.post(
                "{{url('admin/brand/changeShow')}}",
                {value:value,field:field,b_id:b_id},
                function(res){
                    if(res=='ok'){
                        _this.text(new_show).show();
                    }
                }
            )
        })

        //极点即改
        $(document).on('click','.changeName',function () {
            var name = $(this).text()
            $(this).parent().html('<input type="text" class="upd">')
            $(".upd").val('').focus().val(name)
        })
        $(document).on('blur','.upd',function () {
            var obj=$(this)
            var name=$(this).val()
            if(!name){
                alert('不能为空')
                return
            }
            var id = $(this).parent('td').attr('brand_id')
            var n = $(this).parent('td').attr('brand_name')
            if(name==n){
                obj.parent().html('<span class="changeName" >'+name+'</span>')
                return
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                method:"post",
                url:"{{url('/admin/brand/changeName')}}",
                data:{brand_name:name,brand_id:id},
                dataType:"json",
                success:function(res){
                    if(res.code == 0){
                        obj.parent().html('<span class="changeName">'+name+'</span>')
                    }
                }
            })

        })

    </script>


@endsection
