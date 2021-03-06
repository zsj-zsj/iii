<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\GoodsModel;
use App\Model\CateModel;
use App\Model\AttrModel;
use App\Model\SkuModel;
use App\Model\GoodsAttrModel;
use App\Model\Index\HistoryModel;
use Illuminate\Support\Facades\Cookie;

class GoodsController extends Controller
{
    //商品详情页面
    public function goodsDetail()
    {
        //商品数据
        $id=request()->get('goods_id');
        $res=GoodsModel::where('goods_id','=',$id)->join('shop_brand','shop_brand.brand_id','=','shop_goods.brand_id')
                ->select('goods_name','brand_name','goods_id','goods_price','goods_desc','goods_img','goods_time','goods_num')
                ->first($id);
        if(!$res){
            echo "<script>alert('没有次商品');location.href='getCateGoods';</script>";
        }
        //商品属性
        $goodsAttrData = GoodsAttrModel::join('shop_attr','shop_attr.attr_id','=','shop_goods_attr.attr_id')
            ->where(['goods_id'=>$id])
            ->get()->toArray();
        $args = $spec = [];   //spec是可选属性  args不可选属性 普通属性
        foreach($goodsAttrData as $key=>$value){
            //可选属性  分组
            if($value['attr_type'] == 2){
                $status = $value['attr_name'];
                $spec[$status][] = $value;
            }else{
                //普通属性
                $args[] = $value;
            }
        }
        //浏览历史  存
        $user=checkLogin();
        $cookie=Cookie::get('historyGoods');
        $cookie=json_decode($cookie,true);
        if(!$user){
            //cookie
            $arr=[
                'historyTime'=>time(),
                'goods_id'=>$cookie['goods_id'].','.$id
            ];
            $arr=json_encode($arr);
            Cookie::queue('historyGoods',$arr,3600);
        }else{
            //数据库
            $user=session('user.user_id');
            $arr=[
                'user_id'=>$user,
                'goods_id'=>$id,
                'history_time'=>time()
            ];
            HistoryModel::insert($arr);
        }
        //菜单
        $cate=CateModel::getMenu();
        return view('index.goods.goodsDetail',['spec'=>$spec,'args'=>$args,'cate'=>$cate,'goodsInfo'=>$res]);
    }

    public function getPriceNum()
    {
        $goods_attr_id=request()->goods_attr_id;
        $goods_attr_ids=explode(',',$goods_attr_id);
        $attrPrice = GoodsAttrModel::whereIn('goods_attr_id',$goods_attr_ids)
            ->select('attr_price','goods_id')->get()->toArray();

        $count = 0;
        foreach ($attrPrice as $k=>$v){
            $count +=$v['attr_price'];
        }
        //商品基本价格
        $goodsPrice =GoodsModel::where('goods_id','=',$attrPrice[$k]['goods_id'])->first('goods_price')->toArray();

        //基本价格+属性价格
        $prorductPrice=$count+$goodsPrice['goods_price'];
        $productNum = SkuModel::where('goods_attr_id','=',$goods_attr_id)->first('prorduct_num');
        $productNums = collect($productNum)->toArray();
        if(!$productNums){
            return $arr=[
                'code'=>404,
                'msg'=>'没有此组合'
            ];
        }
        return $data = [
            'totalPrice' => $prorductPrice,
            'productNum' => $productNums['prorduct_num']
        ];
    }


    //清空浏览历史
    public function historyNull()
    {
        $user=checkLogin();
        if(!$user){
            $cookie=Cookie::forget('historyGoods');
            header("refresh:0,url='/getCateGoods'");
            return response('')->withCookie($cookie);
        }else{
            //数据库
            $id=session('user.user_id');
            $res=HistoryModel::where(['user_id'=>$id])->delete();
            if($res){
                return redirect('/getCateGoods');
            }
        }
    }
}
