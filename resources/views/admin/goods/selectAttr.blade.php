@extends('admin.layout')
@section('title', '商品列表')
@section('content')

    <div class="row J_mainContent" id="content-main">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>商品管理 <small>商品属性</small></h5>
                            <div class="ibox-tools">
                                <a class="close-link">
                                    🐕
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <a href="{{url('admin/goods/index')}}" class="btn btn-warning">返回列表页面</a>&emsp;&emsp;
                            <a href="{{url('admin/goods/create')}}" class="btn btn-warning">添加</a>
                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                                <thead>
                                @foreach($data as $v)
                                    <tr>
                                        <th data-toggle="true">
                                            属性：<b style="color: red">{{$v->attr_name ?? ''}}</b> &emsp;&emsp;
                                            属性值：<b style="color: red">{{$v->attr_value ?? ''}}</b> &emsp;&emsp;
                                            属性价格：<b style="color: red">{{$v->attr_price ?? ''}}</b> &emsp;&emsp;
                                        </th>
                                    </tr>
                                @endforeach
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
