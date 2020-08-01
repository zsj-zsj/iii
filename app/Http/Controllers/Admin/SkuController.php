<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\GoodsAttrModel;
use Illuminate\Http\Request;
use App\Model\SkuModel;
use App\Model\GoodsModel;
use App\Model\AttrModel;
use Illuminate\Support\Str;

class SkuController extends Controller
{
    public function goodSouch()
    {
        return view('admin.sku.goodSouch');
    }

    public function goodSouchD()
    {
        $goods_name=\request()->goods_name;
        $goods_info=GoodsModel::where(['goods_name'=>$goods_name])->first();
        if(!$goods_info){
            return $arr=[
                'code'=>500,
                'msg'=>'没有此商品'
            ];
        }else{
            return $goods_info->toArray();
        }
    }

    public function getGoods()
    {
        $res=GoodsModel::where(['goods_del'=>1])->get();
        return view('admin.sku.getGoods',['data'=>$res]);
    }

    public function create()
    {
        $goods_id=\request()->id;
        $goods_info=GoodsModel::where(['goods_id'=>$goods_id])->first();
        if(!$goods_info){
            echo "<script>alert('没有此商品');location.href='/admin/goodsSku/goodSouch';</script>";
        }
        $where=[
            'goods_id'=>$goods_id,
            'attr_type'=>2,
            'attr_del'=>1,
            'goods_attr_del'=>1
        ];
        $goodsAttr=GoodsAttrModel::join('shop_attr','shop_attr.attr_id','=','shop_goods_attr.attr_id')
            ->where($where)->get()->toArray();
        $newGoodsAttr=[];
        foreach ($goodsAttr as $k=>$v){
            $newGoodsAttr[$v['attr_name']][]=$v;
        }
        return view('admin.sku.create',['data'=>$goods_info,'newGoodsAttr'=>$newGoodsAttr]);
    }

    public function store()
    {
        $data=\request()->all();
        $size = count($data['goods_attr_id']) / count($data['prorduct_num']);
        $attr_value_list = array_chunk($data['goods_attr_id'],$size);

        $insertData=[];
        foreach ($data['prorduct_num'] as $k=>$v){
            $insertData[]=[
                'goods_id'=>$data['goods_id'],
                'goods_attr_id'=>implode(',',$attr_value_list[$k]),
                'prorduct_num'=>$v,
                'prorduct_sn'=>'SN'.time().Str::random(3),
                'prorduct_time'=>time()
            ];
        }
        $res=SkuModel::insert($insertData);
        if($res){
            return $arr=[
                'code'=>0,
                'msg'=>'ok'
            ];
        }
    }

    public function index(Request $request)
    {
        $where=[
            'prorduct_del'=>1,
            'shop_goods.goods_del'=>1,
        ];
        $res=SkuModel::join('shop_goods','shop_goods.goods_id','=','shop_prorduct.goods_id')
                ->select('prorduct_id','prorduct_sn','prorduct_num','goods_name','prorduct_time','goods_attr_id')
                ->where($where)->paginate(5);
        $sku_list=collect($res)->toArray();

        foreach ($sku_list['data']  as $k=>$v){
            $goods_attr_id=explode(',',$v['goods_attr_id']);
            $attr_value_info=GoodsAttrModel::select('attr_value')->
                        where(['goods_attr_del'=>1])->whereIn('goods_attr_id',$goods_attr_id)->get();
            $attr_value_info=collect($attr_value_info)->toArray();
            $attr_value='';
            foreach ($attr_value_info as $key=>$val){
                $attr_value.=$val['attr_value'].'-';
                $v['attr_value']=$attr_value;
                $v['attr_value']=substr($v['attr_value'],0,strlen($v['attr_value'])-1);
                $sku_list["data"][$k]=$v;
            }
        }
        $query=$request->all();
        if($request->ajax()){
            return view('admin.sku.indexAjax',['data'=>$sku_list['data'],'res'=>$res,'query'=>$query]);
        }

        return view('admin.sku.index',['data'=>$sku_list['data'],'res'=>$res,'query'=>$query]);
    }

    public function souch(Request $request)
    {
        $wheres=[];
        $goods_name=\request()->goods_name;

        if($goods_name){
            $wheres[]=['goods_name','like',"%$goods_name%"];
        }
        $where=[
            'prorduct_del'=>1,
            'shop_goods.goods_del'=>1,
        ];
        $res=SkuModel::join('shop_goods','shop_goods.goods_id','=','shop_prorduct.goods_id')
            ->select('prorduct_id','prorduct_sn','prorduct_num','goods_name','prorduct_time','goods_attr_id')
            ->where($where)->where($wheres)->paginate(5);
        $sku_list=collect($res)->toArray();

        foreach ($sku_list['data']  as $k=>$v){
            $goods_attr_id=explode(',',$v['goods_attr_id']);
            $attr_value_info=GoodsAttrModel::select('attr_value')->
            where(['goods_attr_del'=>1])->whereIn('goods_attr_id',$goods_attr_id)->get();
            $attr_value_info=collect($attr_value_info)->toArray();
            $attr_value='';
            foreach ($attr_value_info as $key=>$val){
                $attr_value.=$val['attr_value'].'-';
                $v['attr_value']=$attr_value;
                $v['attr_value']=substr($v['attr_value'],0,strlen($v['attr_value'])-1);
                $sku_list["data"][$k]=$v;
            }
        }

        $query=$request->all();
        if($request->ajax()){
            return view('admin.sku.indexSouch',['data'=>$sku_list['data'],'res'=>$res,'query'=>$query]);
        }

        return view('admin.sku.index',['data'=>$sku_list['data'],'res'=>$res,'query'=>$query]);
    }

    public function del(Request $request)
    {
        $id=$request->id;
        $res=SkuModel::where(['prorduct_id'=>$id])->update(['prorduct_del'=>2]);
        if($res){
            return $arr=[
                'code'=>0,
                'msg'=>'ok'
            ];
        }
    }

    public function edit()
    {
        $id=\request()->id;
        $res=SkuModel::join('shop_goods','shop_goods.goods_id','shop_prorduct.goods_id')
                    ->select('prorduct_id','goods_attr_id','prorduct_num','prorduct_sn','goods_name')
                    ->find($id);
        if(!$res){
            echo "<script>alert('没有此商品');location.href='index';</script>";
        }

        $info=$res->toArray();
        $goods_attr_id=explode(',',$info['goods_attr_id']);
        $attr_value_info=GoodsAttrModel::select('attr_value')->
                where(['goods_attr_del'=>1])->whereIn('goods_attr_id',$goods_attr_id)->get()->toArray();
        $attr_value='';
        foreach ($attr_value_info as $key=>$val){
            $attr_value.=$val['attr_value'].'-';
            $info['attr_value']=$attr_value;
            $info['attr_value']=substr($info['attr_value'],0,strlen($info['attr_value'])-1);
        }
        return view('admin.sku.edit',['data'=>$info]);
    }

    public function upd()
    {
        $data=\request()->all();
        $res=SkuModel::where(['prorduct_id'=>$data['prorduct_id']])->update($data);
        if($res){
            return $arr=[
                'code'=>0,
                'msg'=>'ok'
            ];
        }
    }

}
