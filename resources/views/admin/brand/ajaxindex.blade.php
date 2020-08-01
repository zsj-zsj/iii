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
            <tr>
                <td>{{$v->brand_name}}</td>
                <td>{{$v->brand_url}}</td>
                <td>{{$v->brand_show==1 ? '是' : '否'}}</td>
                <td><img src="/app/{{$v->brand_img}}" width="50px" height="50px" alt=""> </td>
                <td><span class="pie"> {{date('Y-m-d H:i:s',$v->brand_time)}} </span></td>
                <td>
                    <a href="javascript:;"><b style="color: blue">
                            <i id="del" brand_id="{{$v->brand_id}}" class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                        </b></a> &nbsp;
                    <a href="javascript:;"><b style="color: red">
                            <i class="glyphicon glyphicon-heart" aria-hidden="true"></i>
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
