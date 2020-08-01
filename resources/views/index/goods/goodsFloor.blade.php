<div cate_id="{{$floorInfo['topInfo']['cate_id']}}">
    <div class="i_t mar_10">
        <span class="floor_num"> <font class='num'>{{$num}}</font>F </span>
        <span class="fl">{{$floorInfo['topInfo']->cate_name}}</span>
        <span class="i_mores fr">
            @foreach( $floorInfo['sonInfo'] as $v )
                <a href="javascript:;">{{$v->cate_name}}</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            @endforeach
        </span>
    </div>
    <div class="content">
        <div class="fresh_mid">
            <ul>
                @foreach($floorInfo['goodsInfo'] as $v)
                    <li>
                        <div class="name"><a href="{{url('/goodsDetail')}}?goods_id={{$v->goods_id}}">{{$v->goods_name}}</a></div>
                        <div class="price">
                            <font>￥<span>{{$v->goods_price}}</span></font>
                        </div>
                        <div class="img"><a href="javascript:;"><img src="{{env('APP_URL')}}/app/{{$v->goods_img}}" width="185" height="155" /></a></div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
