<ul class="cate_list">
    @foreach($goods as $v)
        <li>
            <div class="img"><a href="#"><img src="{{env('APP_URL')}}/app/{{$v->goods_img}}" width="210" height="185" /></a></div>
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
