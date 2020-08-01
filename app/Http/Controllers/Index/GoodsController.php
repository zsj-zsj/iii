<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\GoodsModel;
use App\Model\CateModel;
use App\Model\Index\HistoryModel;
use Illuminate\Support\Facades\Cookie;

class GoodsController extends Controller
{
    //商品详情页面
    public function goodsDetail()
    {
        //商品数据
        $id=\request()->goods_id;
        $res=GoodsModel::find($id);

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
        return view('index.goods.goodsDetail',['cate'=>$cate,'goodsInfo'=>$res]);
    }

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