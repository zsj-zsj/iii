<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UserModel;
use App\Model\RoleModel;
use App\Model\RolePermModel;
use App\Model\PermModel;

class UserController extends Controller
{
    /*
     * 注册
     */
    public function reg()
    {
        $role=RoleModel::where(['role_del'=>1])->get();
        return view('admin.user.reg',['role'=>$role]);
    }

    public function doreg()
    {
        $data=\request()->all();
        $info=[
            'user_name'=>$data['user_name'],
            'user_pwd'=>password_hash($data['user_pwd'],PASSWORD_BCRYPT),
            'user_time'=>time(),
            'role_id'=>implode(',',$data['role_id'])
        ];

        $res=UserModel::insert($info);
        if($res){
            return $arr=[
                'code'=>0,
                'msg'=>'ok'
            ];
        }
    }

    public function regIndex()
    {
        $res=UserModel::where(['user_del'=>1,])->get();
        $user_info = collect($res)->toArray();

        foreach ($user_info as $k=>$v){
            $role_id=explode(',',$v['role_id']);
            $role_names=RoleModel::where(['role_del'=>1])->whereIn('role_id',$role_id)->select('role_name')->get();
            $role_name=$role_names->toArray();
            $a='';
            foreach ($role_name as $key=>$val){
                $a.=$val['role_name'].'-';
                $v['role_name']=$a;
                $v['role_name']=rtrim($v['role_name'],'-');
                $user_info[$k]=$v;
            }
        }
        return view('admin.user.regIndex',['data'=>$user_info]);
    }

    public function regDel()
    {
        $id=\request()->user_id;
        $res=UserModel::where(['user_id'=>$id])->update(['user_del'=>2]);
        if($res){
            return $a=[
                'code'=>0,
                'msg'=>'ok'
            ];
        }
    }

    public function regEdit()
    {
        $id=\request()->id;
        $res=UserModel::find($id);
        $user_info=collect($res)->toArray();

        $role_id=explode(',',$user_info['role_id']);

        $user_info['role_id']=$role_id;

        $role_name=RoleModel::where(['role_del'=>1])->whereIn('role_id',$role_id)->select('role_name')->get();
        $role_name=$role_name->toArray();

        $role=RoleModel::where(['role_del'=>1])->get();

        return view('admin.user.regEdit',['user'=>$user_info,'role_name'=>$role_name,'role'=>$role]);
    }

    public function regUpd()
    {
        $data=\request()->all();
        $arr=[
            'user_name'=>$data['user_name'],
            'user_time'=>time(),
            'role_id'=> implode(',',$data['role_id'])
        ];

        $res=UserModel::where(['user_id'=>$data['user_id']])->update($arr);
        if($res){
            return $arr=[
                'code'=>0,
                'msg'=>'ok'
            ];
        }
    }

    public function regPass()
    {
        $id=\request()->user_id;
        $res=UserModel::find($id);
//        dd($res);
        return view('admin.user.regPass',['data'=>$res]);
    }

    public function regPassDo()
    {
        $data=\request()->all();
        $user=UserModel::find($data['user_id']);
        $pass=password_verify($data['user_pwd'],$user->user_pwd);
        if($pass != $data['user_pwd']){
            return $arr=[
                'code'=>500,
                'msg'=>'旧密码不对'
            ];
        }

        if($data['newpwd1'] != $data['newpwd2']){
            return $arr=[
                'code'=>500,
                'msg'=>'新密码不一致'
            ];
        }
        $newPass=password_hash($data['newpwd1'],PASSWORD_BCRYPT);
        $res=UserModel::where(['user_id'=>$data['user_id']])->update(['user_pwd'=>$newPass]);
        if($res){
            return $arr=[
                'code'=>0,
                'msg'=>'ok'
            ];
        }
    }

    /*
    登录
    */
    public function login()
    {
        return view('admin.user.login');
    }

    public function dologin()
    {
        $data=\request()->except('_token');
        $res=UserModel::where(['user_name'=>$data['user_name']])->first();
        if($res){
            $pass=password_verify($data['user_pwd'],$res->user_pwd);
            if($pass){
                $res['perm']=RolePermModel::
                    join('rbac_permission','rbac_permission.permission_id','=','rbac_rp.permission_id')
                    ->where(['role_id'=>$res['role_id']])->where(['rp_del'=>1,'permission_del'=>1])->get()->toArray();
                session(['users'=>$res]);
                session(['name'=>$res->user_name]);
                session(['time'=>date('Y-m-d H:i:s')]);
                return $arr=[
                    'code'=>0,
                    'msg'=>'登录成功'
                ];
            }else{
                return $arr=[
                    'code'=>500,
                    'msg'=>'密码不对'
                ];
            }
        }else{
            return $arr=[
                'code'=>404,
                'msg'=>'没有此用户'
            ];
        }
    }

    public function adminQuit(Request $request)
    {
        $request->session()->flush();
//      session(['user'=>null]);
        return redirect('adminLogin');
    }

}
