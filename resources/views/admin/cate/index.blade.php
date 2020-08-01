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
                            <a href="{{url('admin/cate/create')}}" class="btn btn-warning">添加</a>
                            <div id="ajax">
                                <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                                    <thead>
                                    <tr parent_id="showshow"  >
                                        <th data-hide="all">展示</th>
                                        <th data-toggle="true">分类名称</th>
                                        <th data-hide="all">添加时间</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $v)
                                        <tr cate_id="{{$v->cate_id}}" parent_id="{{$v->parent_id}}">
                                            <td><a href="javascript:;" id="jia">【+】</a></td>
                                            <td >{{str_repeat('-',$v->level*5)}}{{$v->cate_name}}</td>
                                            <td>{{date('Y-m-d H:i:s',$v->cate_time)}}</td>
                                            <td>
                                                <a href="javascript:;"><b style="color: blue">
                                                        <i id="del" cate_id="{{$v->cate_id}}" class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                                                    </b></a> &nbsp;
                                                <a href="javascript:;"><b style="color: red">
                                                        <i id="upd" cate_id="{{$v->cate_id}}" class="glyphicon glyphicon-heart" aria-hidden="true"></i>
                                                    </b></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("tr[parent_id!=0]").hide()
            $("tr[parent_id='showshow']").show()
            $(document).on('click','#jia',function () {
                var _this=$(this)
                var sign = $(this).text()
                var cate_id = $(this).parents('tr').attr('cate_id')
                if(sign=="【+】"){
                    var child=$("tr[parent_id='"+cate_id+"']")
                    if(child.length>0){
                        child.show()
                        _this.text("【-】")
                    }
                }else{
                    $("tr[parent_id='"+cate_id+"']").hide()
                    _this.text("【+】")
                }
            })
        })

        $(document).on('click','#del',function () {
            var cate_id = $(this).attr('cate_id')
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                type: "post",
                data: {cate_id:cate_id},
                url: "{{url('admin/cate/del')}}",
                dataType: 'json',
                success:function (res) {
                    if(res.code == 0){
                        location.href='/admin/cate/index'
                    }else{
                        alert(res.msg)
                    }
                }
            })
        })

        $(document).on('click','#upd',function () {
            var id = $(this).attr("cate_id")
            if(confirm('确认修改吗?')){
                location.href='/admin/cate/edit?id='+id
            }
        })

    </script>


@endsection
