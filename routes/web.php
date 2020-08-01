<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//后台
Route::get('adminLogin','Admin\UserController@login');  //登录视图
Route::post('adminLoginDo','Admin\UserController@dologin');  //执行登录
Route::get('adminQuit','Admin\UserController@adminQuit');  //退出登录

Route::prefix('admin')->middleware('login')->group(function(){
    //注册
    Route::get('reg','Admin\UserController@reg');  //注册视图
    Route::post('doreg','Admin\UserController@doreg');  //注册视图
    Route::get('regIndex','Admin\UserController@regIndex');  //用户列表
    Route::post('regDel','Admin\UserController@regDel');  //用户列表
    Route::get('regEdit','Admin\UserController@regEdit');  //修改
    Route::post('regUpd','Admin\UserController@regUpd');  //修改
    Route::get('regPass','Admin\UserController@regPass');  //修改密码
    Route::post('regPassDo','Admin\UserController@regPassDo');  //修改密码

    Route::get('index','Admin\IndexController@index');   //后台主页
    //品牌
    Route::get('brand/create','Admin\BrandController@create');   //添加
    Route::post('brand/story','Admin\BrandController@story');   //执行添加
    Route::get('brand/index','Admin\BrandController@index');   //列表
    Route::get('brand/souch','Admin\BrandController@souch');   //ajax搜索
    Route::post('brand/del','Admin\BrandController@del');   //删除
    Route::get('brand/edit','Admin\BrandController@edit');   //修改视图
    Route::post('brand/upd','Admin\BrandController@upd');   //执行修改视图
    Route::post('brand/changeShow','Admin\BrandController@changeShow');   //点击是否
    Route::post('brand/changeName','Admin\BrandController@changeName');   //即点即改
    //分类
    Route::get('cate/create','Admin\CateController@create');   //添加
    Route::post('cate/story','Admin\CateController@story');   //执行添加
    Route::get('cate/index','Admin\CateController@index');   //列表
    Route::post('cate/del','Admin\CateController@del');   //删除
    Route::get('cate/edit','Admin\CateController@edit');   //修改
    Route::post('cate/upd','Admin\CateController@upd');   //修改
    //类型
    Route::get('type/create','Admin\TypeController@create');   //添加
    Route::post('type/story','Admin\TypeController@story');   //添加
    Route::get('type/index','Admin\TypeController@index');   //列表
    Route::post('type/del','Admin\TypeController@del');   //删除
    Route::get('type/edit','Admin\TypeController@edit');   //修改
    Route::post('type/upd','Admin\TypeController@upd');   //修改
    //属性
    Route::get('attr/create','Admin\AttrController@create');   //添加
    Route::post('attr/story','Admin\AttrController@story');   //添加
    Route::get('attr/index','Admin\AttrController@index');   //列表
    Route::get('attr/souch','Admin\AttrController@souch');   //ajax搜索
    Route::post('attr/del','Admin\AttrController@del');   //删除
    Route::get('attr/edit','Admin\AttrController@edit');   //修改
    Route::post('attr/upd','Admin\AttrController@upd');   //修改
    //商品
    Route::get('goods/create','Admin\GoodsController@create');   //添加
    Route::post('goods/story','Admin\GoodsController@story');   //添加
    Route::get('goods/index','Admin\GoodsController@index');   //列表
    Route::get('goods/getAttr','Admin\GoodsController@getAttr');   //获取类型下的属性
    Route::get('goods/selectAttr','Admin\GoodsController@selectAttr');   //查看商品属性
    Route::get('goods/souch','Admin\GoodsController@souch');   //搜索
    Route::get('goods/del','Admin\GoodsController@del');   //删除
    Route::get('goods/edit','Admin\GoodsController@edit');   //修改
    Route::post('goods/upd','Admin\GoodsController@upd');   //修改
    //商品属性
    Route::get('goodsAttr/index','Admin\GoodsAttrController@index');   //列表
    Route::get('goodsAttr/souch','Admin\GoodsAttrController@souch');   //搜索
    Route::get('goodsAttr/del','Admin\GoodsAttrController@del');   //删除
    Route::get('goodsAttr/edit','Admin\GoodsAttrController@edit');   //修改
    Route::post('goodsAttr/upd','Admin\GoodsAttrController@upd');   //修改
    //sku 库存
    Route::get('goodsSku/goodSouch','Admin\SkuController@goodSouch');   //搜索商品页
    Route::get('goodsSku/getGoods','Admin\SkuController@getGoods');   //搜索商品页
    Route::get('goodsSku/goodSouchD','Admin\SkuController@goodSouchD');   //执行搜索商品页
    Route::get('goodsSku/create','Admin\SkuController@create');   //sku添加页面
    Route::post('goodsSku/store','Admin\SkuController@store');   //sku执行添加
    Route::get('goodsSku/index','Admin\SkuController@index');   //列表
    Route::get('goodsSku/souch','Admin\SkuController@souch');   //搜索
    Route::get('goodsSku/del','Admin\SkuController@del');   //删除
    Route::get('goodsSku/edit','Admin\SkuController@edit');   //修改
    Route::post('goodsSku/upd','Admin\SkuController@upd');   //执行修改
    //角色
    Route::get('role/create','Admin\RoleController@create'); //添加
    Route::post('role/story','Admin\RoleController@story'); //添加
    Route::get('role/index','Admin\RoleController@index'); //列表
    Route::post('role/del','Admin\RoleController@del'); //删除
    Route::get('role/edit','Admin\RoleController@edit'); //修改
    Route::post('role/upd','Admin\RoleController@upd'); //修改
    //权限
    Route::get('perm/create','Admin\PermController@create'); //添加
    Route::post('perm/story','Admin\PermController@story'); //添加
    Route::get('perm/index','Admin\PermController@index'); //列表
    Route::post('perm/del','Admin\PermController@del'); //删除
    Route::get('perm/edit','Admin\PermController@edit'); //修改
    Route::post('perm/upd','Admin\PermController@upd'); //修改
    //角色权限
    Route::get('rolePerm/create','Admin\RolePermController@create'); //添加
    Route::post('rolePerm/story','Admin\RolePermController@story'); //添加
    Route::get('rolePerm/index','Admin\RolePermController@index'); //列表
    Route::post('rolePerm/del','Admin\RolePermController@del'); //删除
    Route::get('rolePerm/edit','Admin\RolePermController@edit'); //修改
    Route::post('rolePerm/upd','Admin\RolePermController@upd'); //修改
    Route::get('rolePerm/souch','Admin\RolePermController@souch'); //搜索
});

//前台
Route::get('reg','Index\UserController@reg');    //注册视图
Route::post('regMobile','Index\UserController@regMobile');  //手机号注册
Route::post('regMobileSendCode','Index\UserController@regMobileSendCode'); //发送手机验证码
Route::post('regEmail','Index\UserController@regEmail'); //邮箱注册
Route::post('regEmailSendCode','Index\UserController@regEmailSendCode'); //邮箱注册
Route::get('onlyName','Index\UserController@onlyName'); //ajax用户名唯一性
Route::get('login','Index\UserController@login');    //登录
Route::post('loginDo','Index\UserController@loginDo');    //执行登录

Route::get('checkSignature','Index\WxChatController@checkSignature');    //接入微信文档
Route::post('checkSignature','Index\WxChatController@wxMessage');    //接入微信文档
Route::get('wxChat','Index\WxChatController@wxChat');    //生成二维码
Route::get('wxChatStatus','Index\WxChatController@wxChatStatus');    //监听扫码状态

Route::get('/','Index\IndexController@index');    //前台首页
Route::get('getMore','Index\IndexController@getMore');    //楼层
Route::get('getMenu','Index\IndexController@getMenu');    //分类菜单
Route::get('getCateGoods','Index\IndexController@getCateGoods');    //获取首页分类下的商品
Route::get('getBrandGoods','Index\IndexController@getBrandGoods');    //获取品牌下的商品
Route::get('getPCateGoods','Index\IndexController@getPCateGoods');    //获取分类下的商品

Route::get('goodsDetail','Index\GoodsController@goodsDetail');    //获取分类下的商品
Route::get('historyNull','Index\GoodsController@historyNull');    //清空浏览历史


