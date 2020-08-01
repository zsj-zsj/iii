<table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
<tbody>
@foreach($data as $v)
    <tr>
        <td ><b style="color: red">{{$v->goods_name}}</b> </td>
        <td ><b style="color: red">{{$v->attr_name}}</b></td>
        <td ><b style="color: red">{{$v->attr_value}}</b></td>
        <td ><b style="color: red">{{$v->attr_price}}</b></td>
        <td>
            <a href="javascript:;"><b style="color: blue">
                    <i id="del" goods_attr_id="{{$v->goods_attr_id}}" class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                </b></a> &nbsp;
            <a href="javascript:;"><b style="color: red">
                    <i id="upd" goods_attr_id="{{$v->goods_attr_id}}" class="glyphicon glyphicon-heart" aria-hidden="true"></i>
                </b></a>
        </td>
    </tr>
@endforeach
</tbody>
</table>
