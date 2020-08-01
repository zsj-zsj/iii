<table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
    <thead>
    <tr>
        <th data-hide="all">角色名称</th>
        <th data-hide="all">对应权限</th>
        <th>操作</th>
    </tr>
    </thead>
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
    <tfoot>
    <tr>
        <td colspan="5">
            <ul class="pagination pull-right">  {{$data->links()}}</ul>
        </td>
    </tr>
    </tfoot>
</table>
