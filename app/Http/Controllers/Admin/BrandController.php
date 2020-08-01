<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\BrandModel;

class BrandController extends Controller
{
    public function create()
    {
        return view('admin.brand.create');
    }

    public function story()
    {
        $data=request()->all();
        $data['brand_time']=time();
        if(request()->hasFile('brand_img')){
            $data['brand_img']=upload('brand_img');
        }
        $res=BrandModel::insert($data);
        if($res){
            return $arr=[
                'code'=>0,
                'msg'=>'ok'
            ];
        }else{
            return $arr=[
                'code'=>500,
                'msg'=>'no'
            ];
        }
    }

    public function index(Request $request)
    {
        $res=BrandModel::where(['brand_del'=>1])->paginate(3);
        $query=$request->all();
        if($request->ajax()){
            return view('admin.brand.ajaxindex',['data'=>$res,'query'=>$query]);
        }
        return view('admin.brand.index',['data'=>$res,'query'=>$query]);
    }

    public function souch(Request $request)
    {
        $brand_name=$request->b_name;
        $where=[];
        if($brand_name){
            $where[]=['brand_name','like',"%$brand_name%"];
        }
        $res=BrandModel::where(['brand_del'=>1])->where($where)->paginate(3);
        $query=$request->all();
        if($request->ajax()){
            return view('admin.brand.ajaxsouch',['data'=>$res,'query'=>$query]);
        }
        return view('admin.brand.index',['data'=>$res,'query'=>$query]);
    }

    public function del()
    {
        $id=request()->id;
        $res=BrandModel::where(['brand_id'=>$id])->update(['brand_del'=>2]);
        if($res){
            $arr=[
                'code'=>0,
                'msg'=>'删除成功'
            ];
            echo json_encode($arr,JSON_UNESCAPED_UNICODE);
        }
    }

    public function edit(Request $request)
    {
        $id=$request->id;
        $res=BrandModel::where(['brand_id'=>$id])->first();
        return view('admin.brand.edit',['data'=>$res]);
    }

    public function upd(Request $request)
    {
        $data=request()->all();
        $data['brand_time']=time();
        if(request()->hasFile('brand_img')){
            $data['brand_img']=$this->upload('brand_img');
        }
        $res=BrandModel::where(['brand_id'=>$data['brand_id']])->update($data);
        if($res){
            return $arr=[
                'code'=>0,
                'msg'=>'ok'
            ];
        }else{
            return $arr=[
                'code'=>500,
                'msg'=>'no'
            ];
        }
    }

    public function changeShow(Request $request)
    {
        $data=$request->all();
        $res=BrandModel::where(['brand_id'=>$data['b_id']])->update([$data['field']=>$data['value']]);
        if($res){
            echo 'ok';
        }else{
            echo 'no';
        }
    }

    public function changeName()
    {
        $data=request()->all();
        $res=BrandModel::where(['brand_id'=>$data['brand_id']])->update(['brand_name'=>$data['brand_name']]);
        if($res){
            return $arr=[
                'code'=>0,
                'msg'=>'ok'
            ];
        }
    }

}
