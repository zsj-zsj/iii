<table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
    <thead>
    <tr>
        <th data-toggle="true">商品名称</th>
        <th data-hide="all">属性</th>
        <th data-hide="all">sku库存</th>
        <th data-hide="all">货号</th>
        <th data-hide="all">添加时间</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $v)
        <tr>
            <td>{{$v['goods_name']}}</td>
            <td>{{$v['attr_value']}}</td>
            <td>{{$v['prorduct_num']}}</td>
            <td>{{$v['prorduct_sn']}}</td>
            <td>{{date('Y-m-d H:i:s',$v['prorduct_time'])}}</td>
            <td>
                <a href="javascript:;"><b style="color: blue">
                        <i id="del" class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                    </b></a> &nbsp;
                <a href="javascript:;"><b style="color: red">
                        <i id="upd" class="glyphicon glyphicon-heart" aria-hidden="true"></i>
                    </b></a>
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="5">
            <ul class="pagination pull-right">  {{$res->appends($query)->links()}}</ul>
        </td>
    </tr>
    </tfoot>
</table>
