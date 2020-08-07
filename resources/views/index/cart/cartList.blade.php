@extends('index.layout')
@section('title', '购物车列表')
@section('content')
    @include('index.redMenu')

<div class="i_bg">
    <div class="content mar_20">
        <img src="/style/indexStyle/images/img1.jpg" />
    </div>

    <div class="content mar_20">
        <table border="0" class="car_tab" style="width:1200px; margin-bottom:50px;" cellspacing="0" cellpadding="0">
            <tr>
                <td class="car_th"><input id="allBox" type="checkbox"> </td>
                <td class="car_th" width="490">商品名称</td>
                <td class="car_th" width="140">属性</td>
                <td class="car_th" width="150">购买数量</td>
                <td class="car_th" width="130">小计</td>
                <td class="car_th" width="150">操作</td>
            </tr>
            @foreach( $cartInfo as $k=>$v )
            <tr class="" id="styleLine" prorduct_num="{{$v['prorduct_num']}}" goods_num="{{$v['goods_num']}}"  cart_id="{{$v['cart_id']}}" goods_id="{{$v['goods_id']}}">
                <td align="center">
                    <input type="checkbox" class="box">
                </td>
                <td>
                    <div class="c_s_img"><img src="{{env('APP_URL')}}/app/{{$v['goods_img']}}" width="73" height="73" /></div>
                    {{$v['goods_name']}}
                </td>
                <td align="center">
                    @foreach($v['attr_value'] as $key=>$val)
                        {{$key}}：  {{$val}} <br>
                    @endforeach
                </td>
                <td align="center">
                    <div class="c_num">
                        <input type="button" value="+" id="add"  class="car_btn_1" />
                        <input type="text" id="buy_num" value="{{$v['buy_num']}}"  class="car_ipt" />
                        <input type="button" value="-" id="less" class="car_btn_1" />
                    </div>
                </td>
                <td align="center" style="color:#ff4e00;" class="total">￥{{$v['buy_num'] * $v['buy_price']}}</td>
                <td align="center"><a href="javascript:;" id="del">删除</a>&nbsp;<a href="#">加入收藏</a></td>
            </tr>
            @endforeach
            <tr height="70">
                <td colspan="6" style="font-family:'Microsoft YaHei'; border-bottom:0;">
                    <label class="r_rad"></label><label class="r_txt"> <a href="javascript:;" id="delMore">批量删除</a> </label>
                    <label class="r_rad"></label><label class="r_txt"> <a href="">清空购物车</a> </label>
                    <span class="fr">商品总价：<b style="font-size:22px; color:#ff4e00;" id="total_price">￥0</b></span>
                </td>
            </tr>
            <tr valign="top" height="150">
                <td colspan="6" align="right">
                    <a href="{{url('/getCateGoods')}}"><img src="/style/indexStyle/images/buy1.gif" /></a>&nbsp; &nbsp; <a href="#"><img src="/style/indexStyle/images/buy2.gif" /></a>
                </td>
            </tr>
        </table>

    </div>

    <script>
        //批删
        $(document).on('click','#delMore',function () {
            var _box = $(".box:checked")
            var cart_id  = ''
            if(_box.length>0){

            }
        })
        //单删
        $(document).on('click','#del',function () {
            var cart_id = $(this).parents('tr').attr('cart_id')
            $.ajax({
                url : "{{url('/shop/cartDel')}}",
                type : "get",
                data : {cart_id:cart_id},
                dataType : "json",
                success : function (res) {
                    if(res.code == 0){
                        alert(res.msg)
                        location.href='/shop/cartList'
                    }
                }
            })
        })
        //收藏
        //清空

        //全选
        $(document).on('click','#allBox',function(){
            var _this=$(this);
            var status=_this.prop('checked');
            if(status==true){
                $("tr[goods_id]").addClass('car_tr')
            }else{
                $("tr[goods_id]").removeClass('car_tr');
            }
            $('.box').prop('checked',status);
            getCountPrice()
        })
        //选中当前行
        $(document).on('click','.box',function(){
            var _this = $(this);
            var status =_this.prop('checked');
            if(status==true){
                changeLine(_this)
            }else{
                _this.parents('tr').removeClass('car_tr');
            }
            getCountPrice()
        })
        // 加号
        $(document).on('click','#add',function () {
            var _this = $(this)
            var buy_num = _this.next('input').val()  //当前购买数量
            if(buy_num.length <= 0){
                var productNum = parseInt(_this.parents('tr').attr('goods_num'))
            }else{
                var productNum = parseInt(_this.parents('tr').attr('prorduct_num'));
            }
            var buy_num =parseInt( _this.next('input').val())
            var cart_id =_this.parents('tr').attr('cart_id')

            if(buy_num >= productNum){
                alert('库存上限')
                _this.next('input').val(productNum);
            }else{
                buy_num += 1;
                _this.next('input').val(buy_num);
            }
            $('.box').prop('checked',status);

            changeLine(_this)
            changeChecked(_this)
            changeNum(cart_id,buy_num)
            getTotal(_this,cart_id)
            getCountPrice()
        })
        //减号
        $(document).on('click','#less',function () {
            var _this = $(this)
            var buy_num =parseInt( _this.prev('input').val())
            var cart_id =_this.parents('tr').attr('cart_id')
            if( buy_num <= 1 ){
                _this.prev('input').val(1)
            }else{
                buy_num -= 1
                _this.prev('input').val(buy_num)
            }
            changeLine(_this)
            changeChecked(_this)
            changeNum(cart_id,buy_num)
            getTotal(_this,cart_id)
            getCountPrice()
        })
        //失去焦点
        $(document).on('blur','#buy_num',function () {
            var _this = $(this)
            var buy_num = $(this).val()
            if(buy_num.length <= 0){
                var productNum = parseInt(_this.parents('tr').attr('goods_num'))
            }else{
                var productNum = parseInt(_this.parents('tr').attr('prorduct_num'));
            }
            var cart_id =_this.parents('tr').attr('cart_id')
            var reg = /^\d+$/
            if(!reg.test(buy_num) || parseInt(buy_num) <=1){
                _this.val(1)
            }else if(parseInt(buy_num) >= productNum){
                alert('商品数量超限！')
                _this.val(productNum)
            }else{
                _this.val(parseInt(buy_num))
            }
            changeLine(_this)
            changeChecked(_this)
            changeNum(cart_id,buy_num)
            getTotal(_this,cart_id)
            getCountPrice()
        })
        //改变行颜色 选中状态
        function changeLine(_this){
            _this.parents('tr').addClass('car_tr');
        }
        //获取总价
        function getCountPrice() {
            var _box = $(".box:checked")
            var cart_id = ''
            if(_box.length > 0){
                _box.each(function (index) {
                    cart_id += $(this).parents('tr').attr('cart_id')+','
                })
                cart_id = cart_id.substr(0,cart_id.length-1);
                $.ajax({
                    url : "{{url('/shop/getCountPrice')}}",
                    data : {cart_id:cart_id},
                    dataType : "json",
                    success : function (res) {
                        $("#total_price").html("¥"+'<b>'+res.data+'</b>')
                    }
                })
            }else{
                $("#total_price").html("¥<b>0</b>");
            }
        }
        //当前复选框选中
        function changeChecked(_this){
            _this.parents('tr').find('.box').prop('checked',true);
        }

        //购买赋值数量
        function changeNum(cart_id,buy_num) {
            $.ajax({
                url:"{{'/shop/changeNum'}}",
                data:{cart_id:cart_id,buy_num:buy_num},
                dataType:"json",
                async:false,
                success:function(res){
                    if(res.code == 0){
                        return true;
                    }
                    return false;
                }
            });
        }
        //重新获取小计
        function getTotal(_this,cart_id) {
            $.ajax({
                url:"{{'/shop/getTotal'}}",
                data:{cart_id:cart_id},
                success:function (res) {
                    _this.parents('tr').find('.total').text("¥"+res.total);
                }
            })
        }
    </script>

@endsection
