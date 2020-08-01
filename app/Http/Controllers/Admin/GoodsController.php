<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\GoodsModel;
use App\Model\BrandModel;
use App\Model\CateModel;
use App\Model\AttrModel;
use App\Model\TypeModel;
use App\Model\GoodsAttrModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class GoodsController extends Controller
{
    public function create()
    {
        $brand=BrandModel::where(['brand_del'=>1])->get();
        $cate=CateModel::where(['cate_del'=>1])->get();
        $cate=getclassify($cate);
        $type=TypeModel::where(['type_del'=>1])->get();
        return view('admin.goods.create',['brand'=>$brand,'cate'=>$cate,'type'=>$type]);
    }

    public function getAttr()
    {
        $id=request()->type_id;
        $res=AttrModel::where(['type_id'=>$id])->where(['attr_del'=>1])->get()->toArray();
        return json_encode($res,JSON_UNESCAPED_UNICODE);
    }

    public function story()
    {
        $data=\request()->all();
        if(request()->hasFile('goods_img')){
            $data['goods_img']=upload('goods_img');
        }
        $goods_info=[
            'goods_name'=>$data['goods_name'],
            'goods_sn'=>'ZBC'.Str::random(3).time(),
            'cate_id'=>$data['cate_id'],
            'brand_id'=>$data['brand_id'],
            'goods_img'=>$data['goods_img'],
            'goods_price'=>$data['goods_price'],
            'goods_num'=>$data['goods_num'],
            'goods_time'=>time(),
            'goods_desc'=>$data['goods_desc']
        ];
        $goods_id=GoodsModel::insertGetId($goods_info);
        if(!empty($data['goods_attr_id'])){
            foreach ($data['goods_attr_id'] as $k=>$v){
                $goodsAttr_info=[
                    'goods_id'=>$goods_id,
                    'attr_id'=>$v,
                    'attr_value'=>$data['attr_value'][$k],
                    'attr_price'=>$data['attr_price'][$k],
                    'goods_attr_time'=>time()
                ];
                GoodsAttrModel::insert($goodsAttr_info);
            }
        }
        return $arr=[
            'code'=>0,
            'msg'=>'ok',
            'url'=>'/admin/goodsSku/create?id='.$goods_id
        ];
    }

    public function index()
    {
        $whereDel=[
            'brand_del'=>1,
            'cate_del'=>1,
            'goods_del'=>1
        ];
        $res=GoodsModel::join('shop_brand','shop_brand.brand_id','=','shop_goods.brand_id')
                ->join('shop_cate','shop_cate.cate_id','=','shop_goods.cate_id')
                ->where($whereDel)
                ->paginate(2);
        $query=\request()->all();
        if(\request()->ajax()){
            return view('admin.goods.ajaxindex',['data'=>$res,'query'=>$query]);
        }
        $brand=BrandModel::where(['brand_del'=>1])->get();
        $cate=CateModel::where(['cate_del'=>1])->get();
        $cate=getclassify($cate);
        return view('admin.goods.index',['data'=>$res,'query'=>$query,'cate'=>$cate,'brand'=>$brand]);
    }

    public function selectAttr()
    {
        $id=\request()->id;
        $res=GoodsAttrModel::
                join('shop_attr','shop_attr.attr_id','=','shop_goods_attr.attr_id')
                ->where(['goods_attr_del'=>1])
                ->where(['goods_id'=>$id])->get();
        return view('admin.goods.selectAttr',['data'=>$res]);
    }

    public function souch()
    {
        $where=[];
        $goods_name=\request()->goods_name;
        if($goods_name){
            $where[]=['goods_name','like',"%$goods_name%"];
        }
        $brand_id=\request()->brand_id;
        if($brand_id){
            $where[]=['shop_brand.brand_id','like',"%$brand_id%"];
        }
        $cate_id=\request()->cate_id;
        if($cate_id){
            $where[]=['shop_cate.cate_id','like',"%$cate_id%"];
        }
        $query=\request()->all();
        $whereDel=[
            'brand_del'=>1,
            'cate_del'=>1,
            'goods_del'=>1
        ];
        $res=GoodsModel::join('shop_brand','shop_brand.brand_id','=','shop_goods.brand_id')
            ->join('shop_cate','shop_cate.cate_id','=','shop_goods.cate_id')
            ->where($where)
            ->where($whereDel)
            ->paginate(2);
        if(\request()->ajax()){
            return view('admin.goods.indexSouch',['data'=>$res,'query'=>$query]);
        }
        return view('admin.goods.index',['data'=>$res,'query'=>$query]);
    }

    public function del()
    {
        $id=\request()->goods_id;
        DB::beginTransaction();
        try {
            $godos=GoodsModel::where(['goods_id'=>$id])->update(['goods_del'=>2]);
            if(empty($godos)){
                throw new \Exception('商品删除失败');
            }
            $goodsAttr=GoodsAttrModel::where(['goods_id'=>$id])->update(['goods_attr_del'=>2]);
            if(empty($goodsAttr)){
                throw new \Exception('商品属性删除失败');
            }
            DB::commit();
            return $arr=[
                'code'=>0,
                'msg'=>'ok'
            ];
        }catch(\Exception $e){
            DB::rollBack();
            return $arr=[
                'code'=>500,
                'msg'=>$e->getMessage()
            ];
        }
    }

    public function edit()
    {
        $id=\request()->id;
        $brand=BrandModel::where(['brand_del'=>1])->get();
        $cate=CateModel::where(['cate_del'=>1])->get();
        $cate=getclassify($cate);
        $res=GoodsModel::where(['goods_id'=>$id])->first();
        return view('admin.goods.edit',['data'=>$res,'brand'=>$brand,'cate'=>$cate]);
    }

    public function upd(Request $request)
    {
        $data=$request->all();
        if(request()->hasFile('goods_img')){
            $data['goods_img']=upload('goods_img');
        }
        $res=GoodsModel::where(['goods_id'=>$data['goods_id']])->update($data);
        return $arr=[
            'code'=>0,
            'msg'=>'ok'
        ];
    }

}
