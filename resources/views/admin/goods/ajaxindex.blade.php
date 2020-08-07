<div id="ajax">
    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
        <thead>
        <tr  >
            <th data-toggle="true">商品名称</th>
            <th data-hide="all">属性</th>
            <th data-hide="all">货号</th>
            <th data-hide="all">分类</th>
            <th data-hide="all">品牌</th>
            <th data-hide="all">图片</th>
            <th data-hide="all">详情</th>
            <th data-hide="all">价格</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $v)
            <tr>
                <td >{{$v->goods_name}}</td>
                <td  g_id="{{$v->goods_id}}"><a href="javascript:;" id="attr">查看此属性</a> </td>
                <td >{{$v->goods_sn}}</td>
                <td >{{$v->cate_name}}</td>
                <td >{{$v->brand_name}}</td>
                <td ><img src="{{env('APP_URL')}}/app/{{$v->goods_img}}" width="100px" height="100px"> </td>
                <td >{{$v->goods_desc}}</td>
                <td >{{$v->goods_price}}</td>
                <td>
                    <a href="javascript:;"><b style="color: blue">
                            <i id="del"  goods_id="{{$v->goods_id}}" class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                        </b></a> &nbsp;
                    <a href="javascript:;"><b style="color: red">
                            <i id="upd" goods_id="{{$v->goods_id}}" class="glyphicon glyphicon-heart" aria-hidden="true"></i>
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
    <a href="{{url('admin/goods/create')}}" class="btn btn-warning">添加</a>
</div>
