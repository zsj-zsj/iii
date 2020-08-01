<table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
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
</table>
