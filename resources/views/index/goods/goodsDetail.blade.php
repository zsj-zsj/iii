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
                价格：<b class="price">￥{{$goodsInfo->goods_price}}</b><br />
            </div>
            @if($args)
                @foreach($args as $key=>$val)
                    <span>{{$val['attr_name']}}:</span> <span id="spec_weight">{{$val['attr_value']}}</span>
                @endforeach
            @endif
            @if($spec)
            @foreach( $spec as $k=>$v )
                <div class="des_choice">
                    <span class="fl" id="attr_name">{{$k}}：</span>
                    <ul>
                        @foreach($v as $key=>$val)
                            <input type="hidden" value="{{$val['goods_attr_id']}}">
                            <li class="" id="style">{{$val['attr_value']}}<div class="ch_img"></div></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
            @endif
            <div class="des_share">
                <div class="d_care"><a onclick="ShowDiv('MyDiv','fade')">收藏商品</a></div>
            </div>
            <div class="des_join">
                <div class="j_nums">
                    <input type="hidden" id="goods_num" value="{{$goodsInfo->goods_num}}" >
                    <input type="hidden" id="goods_id" value="{{$goodsInfo->goods_id}}" >
                    <input type="text" value="1" name="" class="n_ipt" id="buy_num" />
                    <input type="button" style="background: red" value="+" id="add" class="n_btn_1" />
                    <input type="button" style="background: red" value="-" id="less" class="n_btn_2" />
                </div>
                <span class="fl"><a ><img src="/style/indexStyle/images/j_car.png" id="addCrat" /></a></span>
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
                            <td>商品名称：{{$goodsInfo->goods_name}}</td>
                            <td>品牌： {{$goodsInfo->brand_name}}</td>
                            <td>上架时间：{{date('Y-m-d H:i:s',$goodsInfo->goods_time)}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="des_border" id="p_details">
                <div class="des_t">商品详情</div>
                <div class="des_con">
                    <table border="0" align="center" style="width:745px; font-size:14px; font-family:'宋体';" cellspacing="0" cellpadding="0">
                        <tr>
                           <td>{!!$goodsInfo->goods_desc!!}</td>
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
                        </td>
                    </tr>
                    <tr height="50" valign="bottom">
                        <td>&nbsp;</td>
                        <td><a href="{{url('shop/cartList')}}" class="b_sure">去购物车结算</a><a href="{{url('goodsDetail')}}?goods_id={{$goodsInfo->goods_id}}" class="b_buy">继续购物</a></td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
    <!--End 弹出层-加入购物车 End-->

    <script>
        // 获取 货品库存  价格加属性价格
        $(document).on('click','#style',function () {
            var _this= $(this)
            _this.addClass('checked').siblings('li').removeClass('checked')

            var goods_attr_id = ''
            $(".checked").each(function (index) {
                goods_attr_id +=$(this).prev('input').val()+','
            })
            goods_attr_id = goods_attr_id.substr(0,goods_attr_id.length-1)
            if(goods_attr_id.indexOf(",")!==-1) {
                $.ajax({
                    url: "{{'/getPriceNum'}}",
                    data: {goods_attr_id: goods_attr_id},
                    success: function (res) {
                        // if(res.code == 404){
                        //      alert(res.msg)
                        // }else{             //提示没有次组合
                            $('.price').text(res.totalPrice)
                            $("#goods_num").val(res.productNum)
                        // }
                    }
                })
            }
        })
        //点加号
        $(document).on('click','#add',function () {
            var attr_name = $(".des_choice").find('span')  //属性
            var lenght = $(".checked")                     // 选中的属性值
            if(attr_name.length !=lenght.length ){
                alert('请选择属性')
                return
            }
            var prorduct_num = parseInt($("#goods_num").val())   //货品库存
            var buy_num =parseInt($("#buy_num").val())  //购买数量
            if(buy_num >= prorduct_num){
                alert('库存上限')
                $("#buy_num").val(prorduct_num)
            }else{
                buy_num += 1
                $("#buy_num").val(buy_num)
            }
        })
        //点减号
        $(document).on('click','#less',function () {
            var attr_name = $(".des_choice").find('span')
            var lenght = $('.checked')
            if(attr_name.length !=lenght.length ){
                alert('请选择属性')
                return
            }
            var buy_num = parseInt($("#buy_num").val())
            if(buy_num <= 1){
                $("#buy_num").val(1)
            }else{
                buy_num -= 1;
                $("#buy_num").val(buy_num)
            }
        })
        $(document).on('blur','#buy_num',function () {
            var attr_name = $(".des_choice").find('span')
            var lenght = $('.checked')
            if(attr_name.length !=lenght.length ){
                alert('请选择属性')
                return
            }
            var productNum = parseInt($("#goods_num").val())
            var buyNum = $("#buy_num").val()
            var reg = /^\d+$/
            if(!reg.test(buyNum) || parseInt(buyNum) <=1){
                $("#buy_num").val(1)
            }else if(parseInt(buyNum) >= productNum){
                alert('商品数量超限！')
                $("#buy_num").val(productNum)
            }else{
                $("#buy_num").val(parseInt(buyNum))
            }
        })

        //加入购物车
        $(document).on('click','#addCrat',function () {
            var user_name = "{{session('user.user_name')}}";
            if(!user_name){
                alert('请先登陆！');
                location.href='{{url('/login')}}';
                return false;
            }
            var attr_name = $(".des_choice").find('span')
            var lenght = $('.checked')
            if(attr_name.length !=lenght.length ){
                alert('请选择属性')
                return
            }
            var goods_id = $("#goods_id").val()
            var buy_num = $("#buy_num").val()
            var goods_attr_id = ''
            $('.checked').each(function(index){
                goods_attr_id += $(this).prev('input').val()+','
            })
            goods_attr_id = goods_attr_id.substr(0,goods_attr_id.length-1)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            var obj = $(this)
            $.ajax({
                url : "{{url('/shop/addCart')}}",
                type : "post",
                dataType : "json",
                data : {goods_id:goods_id,buy_num:buy_num,goods_attr_id:goods_attr_id},
                success :function (res) {
                    if(res.code == 0){
                       obj.parent('a').attr("onclick","ShowDiv_1('MyDiv1','fade1')")
                    }else{
                        alert(res.msg)
                    }
                }
            })
        })

    </script>

@endsection
