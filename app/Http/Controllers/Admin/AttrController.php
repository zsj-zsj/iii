<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\TypeModel;
use App\Model\AttrModel;

class AttrController extends Controller
{
    public function create()
    {
        $type=TypeModel::get();
        return view('admin.attr.create',['type'=>$type]);
    }

    public function story()
    {
        $data=\request()->all();
        $data['attr_time']=time();
        $res=AttrModel::insert($data);
        if($res){
            return $arr=[
                'code'=>0,
                'msg'=>'ok'
            ];
        }
    }

    public function index()
    {
        $type=TypeModel::get();
        $res=AttrModel::where(['attr_del'=>1,'type_del'=>1])
                ->join('shop_type','shop_type.type_id','=','shop_attr.type_id')->paginate(3);
        $query=\request()->all();
        if(\request()->ajax()){
            return view('admin.attr.ajaxindex',['data'=>$res,'type'=>$type,'query'=>$query]);
        }
        return view('admin.attr.index',['data'=>$res,'type'=>$type,'query'=>$query]);

    }

    public function souch()
    {
        $type_id=\request()->type_id;
        $where = [];
        if($type_id){
            $where[] =['shop_type.type_id','=',$type_id];
        }
        $res = AttrModel::join('shop_type','shop_type.type_id','=','shop_attr.type_id')
                ->where(['attr_del'=>1,'type_del'=>1])->where($where)->paginate(3);
        $type=TypeModel::get();
        $query=\request()->all();
        if(\request()->ajax()){
            return view('admin.attr.ajaxsouch',['data'=>$res,'type'=>$type,'query'=>$query]);
        }else{
            return view('admin.attr.index',['data'=>$res,'type'=>$type,'query'=>$query]);
        }
    }

    public function del()
    {
        $id=\request()->attr_id;
        $res=AttrModel::where(['attr_id'=>$id])->update(['attr_del'=>2]);
        return $arr=[
            'code'=>0,
            'msg'=>'ok'
        ];
    }

    public function edit()
    {
        $id=\request()->id;
        $res=AttrModel::where(['attr_id'=>$id])->first();
        $type=TypeModel::get();
        return view('admin.attr.edit',['data'=>$res,'type'=>$type]);
    }

    public function upd()
    {
        $data=\request()->all();
        $res=AttrModel::where(['attr_id'=>$data['attr_id']])->update($data);
        return $arr=[
            'code'=>0,
            'msg'=>'ok'
        ];
    }

}
