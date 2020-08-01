<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\CateModel;

class CateController extends Controller
{
    public function create()
    {
        $res=CateModel::get();
        $res=getclassify($res);
        return view('admin.cate.create',['cate'=>$res]);
    }

    public function story(Request $request)
    {
        $data=$request->all();
        $data['cate_time']=time();
        $res=CateModel::insert($data);
        if($res){
            return $arr=[
                'code'=>0,
                'msg'=>'ok'
            ];
        }
    }

    public function index()
    {
        $res=CateModel::where(['cate_del'=>1])->get();
        $res=getclassify($res);
        return view('admin.cate.index',['data'=>$res]);
    }

    public function del()
    {
        $cate_id=\request()->cate_id;
        $count=CateModel::where(['parent_id'=>$cate_id])->count();
        if($count!=0){
            $arr=[
                'code'=>1234,
                'msg'=>'删除失败'
            ];
            echo json_encode($arr,JSON_UNESCAPED_UNICODE);
        }else{
            CateModel::where(['cate_id'=>$cate_id])->update(['cate_del'=>2]);
            $arr=[
                'code'=>0,
                'msg'=>'ok'
            ];
            echo json_encode($arr,JSON_UNESCAPED_UNICODE);
        }
    }

    public function edit()
    {
        $res=CateModel::get();
        $res=getclassify($res);
        $id=request()->id;
        $data=CateModel::where(['cate_id'=>$id])->first();
        return view('admin.cate.edit',['data'=>$data,'cate'=>$res]);
    }

    public function upd()
    {
        $data=request()->all();
        $res=CateModel::where(['cate_id'=>$data['cate_id']])->update($data);
        if($res){
            $arr=[
                'code'=>0,
                'msg'=>'ok'
            ];
            echo json_encode($arr,JSON_UNESCAPED_UNICODE);
        }
    }

}
