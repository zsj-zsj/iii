<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\PermModel;

class PermController extends Controller
{
    public function create()
    {
        return view('admin.permission.create');
    }

    public function story()
    {
        $data=\request()->all();
        $data['permission_time']=time();
        $a=PermModel::insertGetId($data);
        if($a){
            return $arr=[
                'code'=>0,
                'msg'=>'ok'
            ];
        }
    }

    public function index()
    {
        $res=PermModel::where(['permission_del'=>1])->paginate(12);

        if(\request()->ajax()){
            return view('admin.permission.indexAjax',['data'=>$res]);
        }

        return view('admin.permission.index',['data'=>$res]);
    }

    public function del()
    {
        $id=\request()->id;
        PermModel::where(['permission_id'=>$id])->update(['permission_del'=>2]);
        return $arr=[
            'code'=>0,
            'msg'=>'ok'
        ];
    }

    public function edit()
    {
        $id=\request()->id;
        $res=PermModel::find($id);
        return view('admin.permission.edit',['data'=>$res]);
    }

    public function upd()
    {
        $data=\request()->all();
        PermModel::where(['permission_id'=>$data['permission_id']])->update($data);
        return $arr=[
            'code'=>0,
            'msg'=>'ok'
        ];
    }

}
