@extends('admin.layout')
@section('title', 'sku列表')
@section('content')

    <div class="row J_mainContent" id="content-main">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>商品管理 <small>商品名</small></h5>
                            <div class="ibox-tools">
                                <a class="close-link">
                                    🐕
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <a href="{{url('admin/goods/index')}}" class="btn btn-warning">商品列表</a>
                            <a href="{{url('admin/goodsSku/index')}}" class="btn btn-warning">sku列表</a>
                            <div id="ajax">
                                <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                                    所有商品：
                                    <b style="color: red">
                                    @foreach($data as $v)
                                        {{$v->goods_name}} &nbsp;&nbsp;&nbsp;
                                    @endforeach
                                    </b>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    </script>


@endsection
