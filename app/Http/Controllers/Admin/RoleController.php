<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\RoleModel;

class RoleController extends Controller
{
    public function create()
    {
        return view('admin.role.create');
    }

    public function story()
    {
        $data=\request()->all();
        $data['role_time']=time();
        RoleModel::insertGetId($data);
        return $arr=[
            'code'=>0,
            'msg'=>'ok'
        ];
    }

    public function index()
    {
        $res=RoleModel::where(['role_del'=>1])->get();
        return view('admin.role.index',['data'=>$res]);
    }

    public function del()
    {
        $id=\request()->role_id;
        RoleModel::where(['role_id'=>$id])->update(['role_del'=>2]);
        return $arr=[
            'code'=>0,
            'msg'=>'ok'
        ];
    }

    public function edit()
    {
        $id=\request()->id;
        $res=RoleModel::find($id);
        return view('admin.role.edit',['data'=>$res]);
    }

    public function upd()
    {
        $data=\request()->all();
        $res=RoleModel::where(['role_id'=>$data['role_id']])->update(['role_name'=>$data['role_name']]);
        if($res){
            return $a=[
                'code'=>0,
                'msg'=>'ok'
            ];
        }
    }


}
