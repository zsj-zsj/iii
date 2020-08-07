<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Model\GoodsAttrModel;
use App\Model\GoodsModel;
use App\Model\SkuModel;
use Illuminate\Http\Request;
use App\Model\Index\UserModel;
use App\Model\Index\CartModel;
use App\Model\CateModel;

class CartController extends Controller
{
    public function addCart(Request $request)
    {
        $user=session('user');
        $user_info = UserModel::where(['user_name'=>$user['user_name']])->first();
        $user_id=$user_info->user_id;
        $goods_id=$request->goods_id;
        $buy_num=$request->buy_num;
        $data=$request->all();
        if(!$goods_id || !$buy_num){
            return $arr=[
                'code'=>666,
                'msg'=>'？？？'
            ];
        }
        $goods_attr_id=$request->goods_attr_id;
        if(!$goods_attr_id){
            //没有属性
            $goodsInfo = GoodsModel::where(['goods_id'=>$goods_id])
                            ->select('goods_price','goods_num')->first();
            $cartWhere=[
                'goods_id'=>$goods_id,
                'user_id'=>$user_id,
                'cart_del'=>1
            ];
            $cartInfo = GoodsModel::where($cartWhere)->first();
            if(!$cartInfo){
                //添加
                if($buy_num >= $goodsInfo->goods_num){
                    return $arr=[
                        'code'=>500,
                        'msg'=>'库存上限'
                    ];
                }
                CartModel::insert([
                   'user_id'=>$user_id,
                   'goods_id'=>$goods_id,
                   'buy_num'=>$buy_num,
                   'buy_price'=>$goodsInfo->goods_price
                ]);
            }else{
                //累加
                if(($buy_num+$cartInfo->buy_num) >= $goodsInfo->goods_num){
                    return $arr=[
                        'code'=>500,
                        'msg'=>'库存上限'
                    ];
                }
                CartModel::where($cartWhere)->update(['buy_num'=>$buy_num+$cartInfo->buy_num]);
            }
            $arr=[
                'code'=>0,
                'msg'=>'ok'
            ];
        }else{
            //有属性
            $skuWhere = [
                'goods_attr_id' => $goods_attr_id,
                'goods_id' => $goods_id
            ];
            $productInfo = SkuModel::where($skuWhere)->first();    //查寻一条

            if(!$productInfo){
                return $arr=[
                    'code'=>404,
                    'msg'=>'没有该属性组成的商品'
                ];
            }
            //算基本价格 加 属性价格
            $goodsData = GoodsModel::where('goods_id','=',$goods_id)->first();
            //属性价钱
            $goodsAttrId = explode(',',$goods_attr_id);
            $goodsAttrInfo= GoodsAttrModel::whereIn('goods_attr_id',$goodsAttrId)->get()->toArray();
            //基本价钱+属性价钱
            foreach($goodsAttrInfo as $key=>$value){
                $goodsData['goods_price'] += $value['attr_price'];
            }
            $buy_price = $goodsData['goods_price'];
            //检查有没有添加过此商品
            $where = [
                'goods_id' => $goods_id,
                'user_id' => $user_id,
                'prorduct_id' => $productInfo->prorduct_id,
                'cart_del' => 1,
            ];
            $cartInfo = CartModel::where($where)->first();
            if(!$cartInfo){
                //添加
                if(($productInfo['prorduct_num'] - $buy_num) < 0){
                    return $arr=[
                        'code'=>500,
                        'msg'=>'库存上限'
                    ];
                }
                $result = CartModel::create([
                    'goods_id' => $goods_id,
                    'user_id' => $user_id,
                    'buy_num' => $buy_num,
                    'prorduct_id' => $productInfo->prorduct_id,
                    'goods_attr_id' => $goods_attr_id,
                    'buy_price' => $buy_price,
                    'cart_time'=>time()
                ]);
            }else{
                //累加
                if(($productInfo['prorduct_num'] - $buy_num) < 0){
                    return $arr=[
                        'code'=>500,
                        'msg'=>'库存上限'
                    ];
                }
                $result = CartModel::where($where)->update(['buy_num'=>$cartInfo['buy_num']+$buy_num]);
            }
            $arr = [
                'code'=> 0 ,
                'msg'=>'ok'
            ];
        }
        return $arr;
    }

    public function cartList()
    {
        $user = session('user');
        $user_info=UserModel::where(['user_name'=>$user['user_name']])->first();
        $user_id = $user_info->user_id;

        $cartwhere=[
            'cart_del'=>1,
            'user_id'=>$user_id
        ];
        $cartInfo=CartModel::join('shop_goods','shop_goods.goods_id','=','u_cart.goods_id')
                    ->leftjoin('shop_prorduct','shop_prorduct.prorduct_id','=','u_cart.prorduct_id')
                    ->where($cartwhere)->get()->toArray();
        foreach ($cartInfo as $key=>$val){
            $goodsAttrId = explode(',',$val['goods_attr_id']);
            $goodsAttr = GoodsAttrModel::join('shop_attr','shop_attr.attr_id','=','shop_goods_attr.attr_id')
                        ->select('attr_name','attr_value')->whereIn('goods_attr_id',$goodsAttrId)
                        ->get()->toArray();
            if($goodsAttr == []){
                $cartInfo[$key]['attr_value'] = [];
            }
            foreach($goodsAttr as $k=>$v){
                $cartInfo[$key]['attr_value'][$v['attr_name']] = $v['attr_value'];
            }
        }
        //菜单
        $cate=CateModel::get();
        $cate=getCateInfo($cate);
        return view('index.cart.cartList',['cate'=>$cate,'cartInfo'=>$cartInfo]);
    }

    //总价
    public function getCountPrice()
    {
        $cart_id=\request()->cart_id;
        if(!$cart_id){
            return $arr=[
                'code'=>666,
                'msg'=>'?????'
            ];
        }
        $cart_id = explode(',',$cart_id);
        $cart_info = CartModel::whereIn('cart_id',$cart_id)->select('buy_num','buy_price')->get()->toArray();

        $count = 0;
        foreach ($cart_info as $k=>$v){
            $count += $v['buy_num'] * $v['buy_price'];
        }
        return $arr=[
            'data'=>$count
        ];
    }
    //改变input购买数值
    public function changeNum()
    {
        $buy_num = \request()->buy_num;
        $cate_id = \request()->cart_id;
        if(!$buy_num || !$cate_id){
            return $arr=[
                'code'=>66,
                'msg'=>？？？
            ];
        }
        $num=CartModel::where(['cart_id'=>$cate_id])->update(['buy_num'=>$buy_num]);
        if($num){
            return $arr=[
                'code'=>0,
                'msg'=>'ok'
            ];
        }
    }
    //重新获取小计
    public function getTotal()
    {
        $cart_id=\request()->cart_id;
        if(!$cart_id){
            return $arr=[
                'code'=>666,
                'msg'=>？？？
            ];
        }
        $cartInfo = CartModel::where(['cart_id'=>$cart_id])->first()->toArray();
        $total = $cartInfo['buy_num'] * $cartInfo['buy_price'];
        if($total){
            return $arr=[
                'total'=>$total
            ];
        }
    }

    public function cartDel()
    {
        $cart_id=\request()->cart_id;
        $res=CartModel::where(['cart_id'=>$cart_id])->update(['cart_del'=>2]);
        if($res){
            return $arr=[
                'code'=>0,
                'msg'=>'删除成功'
            ];
        }
    }

}
