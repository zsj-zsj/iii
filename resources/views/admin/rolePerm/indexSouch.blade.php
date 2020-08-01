<table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
<tbody>
@foreach($data as $v)
    <tr>
        <td>{{$v->role_name}}</td>
        <td>{{$v->permission_name}}</td>
        <td>
            <a href="javascript:;"><b style="color: blue">
                    <i id="del" rp_id="{{$v->rp_id}}" class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                </b></a> &nbsp;
            <a href="javascript:;"><b style="color: red">
                    <i id="upd" rp_id="{{$v->rp_id}}" class="glyphicon glyphicon-heart" aria-hidden="true"></i>
                </b></a>
        </td>
    </tr>
@endforeach
</tbody>
</table>
