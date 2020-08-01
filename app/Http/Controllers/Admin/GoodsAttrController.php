<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\AttrModel;
use App\Model\TypeModel;
use Illuminate\Http\Request;
use App\Model\GoodsAttrModel;

class GoodsAttrController extends Controller
{
    public function index()
    {
        $whereDel=[
            'goods_attr_del'=>1,
            'goods_del'=>1,
            'attr_del'=>1
        ];
        $res=GoodsAttrModel::join('shop_goods','shop_goods.goods_id','=','shop_goods_attr.goods_id')
                ->join('shop_attr','shop_attr.attr_id','=','shop_goods_attr.attr_id')
                ->where($whereDel)->paginate(10);
        $query=\request()->all();

        $attr=AttrModel::where(['attr_del'=>1])->get();

        if(\request()->ajax()){
            return view('admin.goodsAttr.indexAjax',['data'=>$res,'query'=>$query,'attr'=>$attr]);
        }
        return view('admin.goodsAttr.index',['data'=>$res,'query'=>$query,'attr'=>$attr]);
    }

    public function souch()
    {
        $where=[];
        $goods_name=\request()->goods_name;
        if($goods_name){
            $where[]=['shop_goods.goods_name','like',"%$goods_name%"];
        }
        $attr_id=\request()->attr_id;
        if($attr_id){
            $where[]=['shop_attr.attr_id','like',"%$attr_id%"];
        }
        $whereDel=[
            'goods_attr_del'=>1,
            'goods_del'=>1,
            'attr_del'=>1
        ];
        $res=GoodsAttrModel::join('shop_goods','shop_goods.goods_id','=','shop_goods_attr.goods_id')
            ->join('shop_attr','shop_attr.attr_id','=','shop_goods_attr.attr_id')
            ->where($where)->paginate(10);
        $query=\request()->all();
        if(\request()->ajax()){
            return view('admin.goodsAttr.indexSouch',['data'=>$res,'query'=>$query]);
        }
        return view('admin.goodsAttr.index',['data'=>$res,'query'=>$query]);
    }

    public function del()
    {
        $id=\request()->goods_attr_id;
        $res=GoodsAttrModel::where(['goods_attr_id'=>$id])->update(['goods_attr_del'=>2]);
        return $arr=[
            'code'=>0,
            'msg'=>'ok'
        ];
    }

    public function edit()
    {
        $id=\request()->id;
        $res=GoodsAttrModel::
                join('shop_attr','shop_attr.attr_id','=','shop_goods_attr.attr_id')
                ->join('shop_goods','shop_goods.goods_id','=','shop_goods_attr.goods_id')
                ->where(['goods_attr_id'=>$id])->first();
        return view('admin.goodsAttr.edit',['data'=>$res]);
    }

    public function upd()
    {
        $data=\request()->all();
        $res=GoodsAttrModel::where(['goods_attr_id'=>$data['goods_attr_id']])->update($data);
        return $arr=[
            'code'=>0,
            'msg'=>'ok'
        ];
    }

}
