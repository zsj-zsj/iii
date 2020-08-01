<table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
    <tbody>
    @foreach($data as $v)
        <tr>
            <td >{{$v->goods_name}}</td>
            <td style="color: red" g_id="{{$v->goods_id}}"><a href="javascript:;" id="attr">查看此属性</a> </td>
            <td >{{$v->goods_sn}}</td>
            <td >{{$v->cate_name}}</td>
            <td >{{$v->brand_name}}</td>
            <td ><img src="{{env('APP_URL')}}/app/{{$v->goods_img}}" width="100px" height="100px"> </td>
            <td >{{$v->goods_desc}}</td>
            <td >{{$v->goods_price}}</td>
            <td>
                <a href="javascript:;"><b style="color: blue">
                        <i id="del" attr_id="{{$v->attr_id}}" class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                    </b></a> &nbsp;
                <a href="javascript:;"><b style="color: red">
                        <i id="upd" attr_id="{{$v->attr_id}}" class="glyphicon glyphicon-heart" aria-hidden="true"></i>
                    </b></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
