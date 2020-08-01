<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\CateModel;
use App\Model\GoodsModel;
use App\Model\BrandModel;
use App\Model\Index\HistoryModel;
use Illuminate\Support\Facades\Cookie;

class IndexController extends Controller
{
    public function index()
    {
        //楼层
        $c_id=1;
        $floorInfo=$this->getFloorInfo($c_id);
        //红色菜单
        $cate=CateModel::get();
        $cate=getCateInfo($cate);
        return view('index.index.index',['cate'=>$cate,'floorInfo'=>$floorInfo]);
    }
    //获取楼层数据
    public function getFloorInfo($c_id){
        //顶级分类
        $floorInfo['topInfo']=CateModel::find($c_id);
        //二及分类
        $floorInfo['sonInfo']=CateModel::where('parent_id','=',$c_id)->get();
        //顶级分类下的数据
        $cateGoodsInfo=CateModel::where(['cate_del'=>1])->get();
        $c_id=getCateId($cateGoodsInfo,$c_id);
        $floorInfo['goodsInfo']=GoodsModel::where(['goods_del'=>1])->whereIn('cate_id',$c_id)
            ->orderBy('goods_id','desc')->take(8)->get();
        return $floorInfo;
    }

    //点击加载楼层
    public function getMore(Request $request)
    {
        $cate_id=$request->cate_id;
        $num=$request->num;
        $numNext=$num+1;
        $where=[
            ['parent_id','=','0'],
            ['cate_id','>',$cate_id]
        ];
        $cate_id = CateModel::where($where)->limit(1)->value('cate_id');
        $floorInfo=$this->getFloorInfo($cate_id);
        return view('index.goods.goodsFloor',['floorInfo'=>$floorInfo,'num'=>$numNext]);
    }

    //菜单
    public function getMenu()
    {
        $cate = CateModel::getMenu();
        return view('index.redMenu',['cate'=>$cate]);
    }

    //分类下的商品
    public function getCateGoods()
    {
        //所有商品
        $goods_info=GoodsModel::where(['goods_del'=>1])
            ->select('goods_name','goods_price','goods_img','goods_id')->paginate(8);
        //品牌
        $brand=BrandModel::where(['brand_del'=>1])->select('brand_name','brand_id')->get();

        //浏览历史
        $user=checkLogin();
        if(empty($user)){
            //取cookie
            $cookie=Cookie::get('historyGoods');
            $cookie=json_decode($cookie,true);
            $goods_id=ltrim($cookie['goods_id'],',');
            $goods_id=explode(',',$cookie['goods_id']);
            $goods_id=array_unique($goods_id);
            $goods_id=array_slice($goods_id,-2);
            $goods_id=array_reverse($goods_id);
            $history=GoodsModel::where(['goods_del'=>1])->whereIn('goods_id',$goods_id)
                ->select('goods_name','goods_img','goods_price','goods_id')->get();
        }else{
            //取数据库
            $user_id=session('user.user_id');
            $history=HistoryModel::where(['user_id'=>$user_id])
                    ->join('shop_goods','shop_goods.goods_id','=','u_history.goods_id')
                    ->select('goods_name','goods_img','goods_price','user_id')->orderBy('history_id','desc')->limit('2')->get();
        }
        //菜单
        $cate = CateModel::getMenu();
        if(\request()->ajax()){
            return view('index.goods.goodsLimit',['cate'=>$cate,'goods'=>$goods_info,'brand'=>$brand]);
        }
        return view('index.goods.goodsInfo',['cate'=>$cate,'goods'=>$goods_info,'brand'=>$brand,'history'=>$history]);
    }

    //点击分类 获取分类下的商品
    public function getBrandGoods()
    {
        $brand_id=\request()->brand_id;
        $where=[];
        if($brand_id){
            $where[]=['brand_id','=',"$brand_id"];
        }
        $res=GoodsModel::where(['goods_del'=>1])->where($where)->get();
        if(\request()->ajax()){
            return view('index.goods.getBrandGoods',['goods'=>$res]);
        }
    }

    //获取导航栏分类下所有商品
    public function getPCateGoods()
    {
        $id=request()->cate_id;
        $cateInfo=CateModel::where(['cate_del'=>1])->get();
        $c_id=getCateId($cateInfo,$id);
        $goodsInfo = GoodsModel::whereIn('cate_id',$c_id)->get();
        if(\request()->ajax()){
            return view('index.goods.getPCateGoods',['goods'=>$goodsInfo]);
        }
    }
}
