<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\TypeModel;
use App\Model\AttrModel;

class TypeController extends Controller
{
    public function create()
    {
        return view('admin.type.create');
    }

    public function story(Request $request)
    {
        $data=$request->input();
        $data['type_time']=time();
        $res=TypeModel::insert($data);
        return $arr=[
            'code'=>0,
            'msg'=>'ok'
        ];
    }

    public function index()
    {
        $res=TypeModel::where(['type_del'=>1])->get();
        foreach($res as $k=>$v){
            $res[$k]['attr_num']=AttrModel::where(['type_id'=>$v['type_id']])->where(['attr_del'=>1])->count();
        }
        return view('admin.type.index',['data'=>$res]);
    }

    public function del()
    {
        $id=\request()->type_id;
        $count=AttrModel::where(['type_id'=>$id])->count();
        if($count != 0){
            return $arr=[
                'code'=>500,
                'msg'=>'删除失败'
            ];
        }else{
            $res=TypeModel::where(['type_id'=>$id])->update(['type_del'=>2]);
            return $arr=[
                'code'=>0,
                'msg'=>'ok'
            ];
        }
    }

    public function edit()
    {
        $id=\request()->id;
        $res=TypeModel::where(['type_id'=>$id])->first();
        return view('admin.type.edit',['data'=>$res]);
    }

    public function upd()
    {
        $data=\request()->all();
        $res=TypeModel::where(['type_id'=>$data['type_id']])->update($data);
        return $arr=[
            'code'=>0,
            'msg'=>'ok'
        ];
    }

}
