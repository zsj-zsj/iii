<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\RoleModel;
use App\Model\PermModel;
use App\Model\RolePermModel;

class RolePermController extends Controller
{
    public function create()
    {
        $role=RoleModel::where(['role_del'=>1])->get();
        $perm=PermModel::where(['permission_del'=>1])->get();
        return view('admin.rolePerm.create',['role'=>$role,'perm'=>$perm]);
    }

    public function story()
    {
        $data=\request()->all();
        $arr=[];
        foreach($data['arr'] as $k=>$v){
            $arr[]=[
                'role_id'=>$data['role_id'],
                'permission_id'=>$v,
                'rp_time'=>time()
            ];
        }
        $res=RolePermModel::insert($arr);
        if($res) {
            return $arr = [
                'code' => 0,
                'msg' => "ok"
            ];
        }
    }

    public function index()
    {
        $where=[
            'rbac_permission.permission_del'=>1,
            'rbac_role.role_del'=>1,
            'rp_del'=>1
        ];
        $res=RolePermModel::where($where)
            ->join('rbac_role','rbac_role.role_id','=','rbac_rp.role_id')
            ->join('rbac_permission','rbac_permission.permission_id','=','rbac_rp.permission_id')
            ->select('rp_id','role_name','permission_name')
            ->paginate(13);
        if(\request()->all()){
            return view('admin.rolePerm.indexAjax',['data'=>$res]);
        }
        return view('admin.rolePerm.index',['data'=>$res]);
    }

    public function del()
    {
        $id=\request()->rp_id;
        RolePermModel::where(['rp_id'=>$id])->update(['rp_del'=>2]);
        return $arr=[
            'code'=>0,
            'msg'=>'ok'
        ];
    }

    public function edit()
    {
        $id=\request()->id;
        $rp=RolePermModel::find($id);
        $perm=PermModel::get();
        $role=RoleModel::get();
        return view('admin.rolePerm.edit',['rp'=>$rp,'perm'=>$perm,'role'=>$role]);
    }

    public function upd()
    {
        $data=\request()->all();
        $res=RolePermModel::where(['rp_id'=>$data['rp_id']])->update($data);
        if($res){
            return $a=[
                'code'=>0,
                'msg'=>'ok'
            ];
        }
    }

    public function souch()
    {
        $wheres=[];
        $role_name=\request()->role_name;
        if($role_name){
            $wheres[]=['role_name','like',"%$role_name%"];
        }

        $where=[
            'rbac_permission.permission_del'=>1,
            'rbac_role.role_del'=>1,
            'rp_del'=>1
        ];
        $res=RolePermModel::where($where)->where($wheres)
            ->join('rbac_role','rbac_role.role_id','=','rbac_rp.role_id')
            ->join('rbac_permission','rbac_permission.permission_id','=','rbac_rp.permission_id')
            ->select('rp_id','role_name','permission_name')
            ->paginate(2);
        if(\request()->all()){
            return view('admin.rolePerm.indexSouch',['data'=>$res]);
        }
        return view('admin.rolePerm.index',['data'=>$res]);
    }
}
