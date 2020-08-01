<table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
    <thead>
    <tr>
        <th data-hide="all">权限</th>
        <th data-hide="all">权限url</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $v)
        <tr>
            <td>{{$v->permission_name}}</td>
            <td>{{$v->permission_url}}</td>
            <td>
                <a href="javascript:;"><b style="color: blue">
                        <i id="del" permission_id="{{$v->permission_id}}" class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                    </b></a> &nbsp;
                <a href="javascript:;"><b style="color: red">
                        <i id="upd" permission_id="{{$v->permission_id}}" class="glyphicon glyphicon-heart" aria-hidden="true"></i>
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
