<table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
<tbody>
@foreach($data as $v)
    <tr>
        <td >{{$v->attr_name}}</td>
        <td >{{$v->type_name}}</td>
        <td>{{date('Y-m-d H:i:s',$v->attr_time)}}</td>
        <td >{{$v->attr_type==1 ? '规格' : '可选'}}</td>
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
