@extends('index.layout')
@section('title', '商品')
@section('content')
    @include('index.redMenu')

<div class="i_bg">
    <div class="postion">
        <span class="n_ch" style="display: none;" id="brand_name">
            <span class="fl">品牌：<font> </font></span>
            <a href="#"><img src="/style/indexStyle/images/s_close.gif" /></a>
        </span>
    </div>
    <!--Begin 筛选条件 Begin-->
    <div class="content mar_10">
        <table border="0" class="choice" style="width:100%; font-family:'宋体'; margin:0 auto;" cellspacing="0" cellpadding="0">
            <tr valign="top">
                <td width="70">品牌：</td>
                <td class="td_a">
                    @foreach($brand as $v)
                    <a href="javascript:;"  class="brand_name" brand_id="{{$v->brand_id}}" >{{$v->brand_name}}</a>
                    @endforeach
                </td>
            </tr>
        </table>
    </div>
    <!--End 筛选条件 End-->

    <div class="content mar_20">
        <div class="l_history">
            <div class="his_t">
                <span class="fl">浏览历史</span>
                <span class="fr"><a href="{{url('/historyNull')}}" >清空</a></span>
            </div>
            <ul>
                @foreach($history as $v)
                <li>
                    <div class="img"><a href="#"><img src="{{env('APP_URL')}}/app/{{$v->goods_img}}" width="185" height="162" /></a></div>
                    <div class="name"><a href="#">{{$v->goods_name}}</a></div>
                    <div class="price">
                        <font>￥<span>{{$v->goods_price}}</span></font>
                    </div>
                </li>
                    @endforeach
            </ul>
        </div>
        <div class="l_list">
            <div class="list_c">
                <div id="ajax">
                <ul class="cate_list">
                    @foreach($goods as $v)
                    <li>
                        <div class="img"><a href="javascript:;"><img src="{{env('APP_URL')}}/app/{{$v->goods_img}}" width="210" height="185" /></a></div>
                        <div class="price">
                            <font>￥<span>{{$v->goods_price}}</span></font> &nbsp;
                        </div>
                        <div class="name"><a href="{{url('/goodsDetail')}}?goods_id={{$v->goods_id}}">{{$v->goods_name}}</a></div>
                        <div class="carbg">
                            <a href="#" class="ss">收藏</a>
                            <a href="#" class="j_car">加入购物车</a>
                        </div>
                    </li>
                    @endforeach
                </ul>
                <div class="pages">
                    {{$goods->links()}}
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        //分页
        $(document).on('click','.pagination a',function(){
            var url=$(this).attr('href')
            $.get(url,function(msg){
                $('#ajax').html(msg)
            })
            return false
        })
        //点击品牌
        $(document).on('click','.brand_name',function () {
            var _this=$(this)
            _this.addClass('now').siblings('a').removeClass('now')  //样式点击变红其他的移出
            var brand_name = _this.text()
            $("#brand_name").show().find('font').text(brand_name)
            $("#goods_price").hide().find('font').text('')

            var brand_id = $('.brand_name.now').attr('brand_id')
            $.get(
                "{{url('/getBrandGoods')}}",
                {brand_id:brand_id},
                function (res) {
                    $(".cate_list").html(res);
                }
            ),'json'
        })

    </script>

@endsection
