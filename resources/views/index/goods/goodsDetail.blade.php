@extends('index.layout')
@section('title', '商品')
@section('content')
    @include('index.redMenu')

<div class="i_bg">
    <div class="content">
        <div id="tsShopContainer">
            <div id="tsImgS"><a href="{{env('APP_URL')}}/app/{{$goodsInfo->goods_img}}" title="Images" class="MagicZoom" id="MagicZoom"><img src="{{env('APP_URL')}}/app/{{$goodsInfo->goods_img}}" width="390" height="390" /></a></div>
        </div>
        <div class="pro_des">
            <div class="des_name">
                商品名称：<b style="color: red">{{$goodsInfo->goods_name}}</b>
            </div>
            <div class="des_price">
                价格：<b>￥{{$goodsInfo->goods_price}}</b><br />
            </div>
            @foreach( $attrName as $k=>$v )
            <div class="des_choice">

                    <span class="fl">{{$v['attr_name']}}：</span>
                    <ul>
                        @foreach($v['attr_value'] as $k=>$v)
                        <li class="" id="style">{{$v}}<div class="ch_img"></div></li>
                        @endforeach
                    </ul>

            </div>
            @endforeach
            <div class="des_share">
                <div class="d_care"><a onclick="ShowDiv('MyDiv','fade')">收藏商品</a></div>
            </div>
            <div class="des_join">
                <div class="j_nums">
                    <input type="text" value="1" name="" class="n_ipt" />
                    <input type="button" style="background: red" value="+" id="add" class="n_btn_1" />
                    <input type="button" style="background: red" value="-" id="less" class="n_btn_2" />
                </div>
                <span class="fl"><a onclick="ShowDiv_1('MyDiv1','fade1')"><img src="/style/indexStyle/images/j_car.png" /></a></span>
            </div>
        </div>

    </div>
    <div class="content mar_20">
        <div class="l_history">
            <div class="fav_t">用户还喜欢</div>
            <ul>
                <li>
                    <div class="img"><a href="#"><img src="/style/indexStyle/images/his_1.jpg" width="185" height="162" /></a></div>
                    <div class="name"><a href="#">Dior/迪奥香水2件套装</a></div>
                    <div class="price">
                        <font>￥<span>368.00</span></font> &nbsp; 18R
                    </div>
                </li>
            </ul>
        </div>
        <div class="l_list">
            <div class="des_border">
                <div class="des_tit">
                    <ul>
                        <li class="current"><a href="#p_attribute">商品属性</a></li>
                        <li><a href="#p_details">商品详情</a></li>
                        <li><a href="#p_comment">商品评论</a></li>
                    </ul>
                </div>
                <div class="des_con" id="p_attribute">

                    <table border="0" align="center" style="width:100%; font-family:'宋体'; margin:10px auto;" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>商品名称：迪奥香水</td>
                            <td>商品编号：1546211</td>
                            <td>品牌： 迪奥（Dior）</td>
                            <td>上架时间：2015-09-06 09:19:09 </td>
                        </tr>
                        <tr>
                            <td>商品毛重：160.00g</td>
                            <td>商品产地：法国</td>
                            <td>香调：果香调香型：淡香水/香露EDT</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>容量：1ml-15ml </td>
                            <td>类型：女士香水，Q版香水，组合套装</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>


                </div>
            </div>

            <div class="des_border" id="p_details">
                <div class="des_t">商品详情</div>
                <div class="des_con">
                    <table border="0" align="center" style="width:745px; font-size:14px; font-family:'宋体';" cellspacing="0" cellpadding="0">
                        <tr>
                           <td>{{$goodsInfo->goods_desc}}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="des_border" id="p_comment">
                <div class="des_t">商品评论</div>

                <table border="0" class="jud_tab" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="jud_bg">您可对已购买商品进行评价<br /><a href="#"><img src="/style/indexStyle/images/btn_jud.gif" /></a></td>
                    </tr>
                </table>

                <table border="0" class="jud_list" style="width:100%; margin-top:30px;" cellspacing="0" cellpadding="0">
                    <tr valign="top">
                        <td width="160"><img src="/style/indexStyle/images/peo1.jpg" width="20" height="20" align="absmiddle" />&nbsp;向死而生</td>
                        <td width="180">
                            颜色分类：<font color="#999999">粉色</font> <br />
                            型号：<font color="#999999">50ml</font>
                        </td>
                        <td>
                            产品很好，香味很喜欢，必须给赞。 <br />
                            <font color="#999999">2015-09-24</font>
                        </td>
                    </tr>
                </table>

                <div class="pages">
                    <a href="#" class="p_pre">上一页</a><a href="#" class="cur">1</a><a href="#">2</a><a href="#">3</a>...<a href="#">20</a><a href="#" class="p_pre">下一页</a>
                </div>

            </div>


        </div>
    </div>


    <!--Begin 弹出层-收藏成功 Begin-->
    <div id="fade" class="black_overlay"></div>
    <div id="MyDiv" class="white_content">
        <div class="white_d">
            <div class="notice_t">
                <span class="fr" style="margin-top:10px; cursor:pointer;" onclick="CloseDiv('MyDiv','fade')"><img src="/style/indexStyle/images/close.gif" /></span>
            </div>
            <div class="notice_c">

                <table border="0" align="center" style="margin-top:;" cellspacing="0" cellpadding="0">
                    <tr valign="top">
                        <td width="40"><img src="/style/indexStyle/images/suc.png" /></td>
                        <td>
                            <span style="color:#3e3e3e; font-size:18px; font-weight:bold;">您已成功收藏该商品</span><br />
                            <a href="#">查看我的关注 >></a>
                        </td>
                    </tr>
                    <tr height="50" valign="bottom">
                        <td>&nbsp;</td>
                        <td><a href="#" class="b_sure">确定</a></td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
    <!--End 弹出层-收藏成功 End-->

    <!--Begin 弹出层-加入购物车 Begin-->
    <div id="fade1" class="black_overlay"></div>
    <div id="MyDiv1" class="white_content">
        <div class="white_d">
            <div class="notice_t">
                <span class="fr" style="margin-top:10px; cursor:pointer;" onclick="CloseDiv_1('MyDiv1','fade1')"><img src="/style/indexStyle/images/close.gif" /></span>
            </div>
            <div class="notice_c">

                <table border="0" align="center" style="margin-top:;" cellspacing="0" cellpadding="0">
                    <tr valign="top">
                        <td width="40"><img src="/style/indexStyle/images/suc.png" /></td>
                        <td>
                            <span style="color:#3e3e3e; font-size:18px; font-weight:bold;">宝贝已成功添加到购物车</span><br />
                            购物车共有1种宝贝（3件） &nbsp; &nbsp; 合计：1120元
                        </td>
                    </tr>
                    <tr height="50" valign="bottom">
                        <td>&nbsp;</td>
                        <td><a href="#" class="b_sure">去购物车结算</a><a href="#" class="b_buy">继续购物</a></td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
    <!--End 弹出层-加入购物车 End-->

    <script>
        $(document).on('click','#style',function () {
            var _this= $(this)
            _this.addClass('checked').siblings('li').removeClass('checked')
        })
        //-

    </script>

@endsection
