<!--Begin Menu Begin-->
<div class="menu_bg">
    <div class="menu">
        <!--Begin 商品分类详情 Begin-->
        <div class="nav">
            <div class="nav_t">全部商品分类</div>
            <div class="leftNav">
                <ul>
                    <?php $i=0; ?>
                    @foreach($cate as $k=>$v)
                        <li>
                            <div class="fj">
                                <span class="n_img"><span></span><img src="/style/indexStyle/images/nav1.png" /></span>
                                <span class="fl">{{$v->cate_name}}</span>
                            </div>
                            <div class="zj" style="top:-{{$i*40}}px;">
                                <div class="zj_l">
                                    @foreach($v['son'] as $vv)
                                        <div class="zj_l_c">
                                            <h2>{{$vv['cate_name']}}</h2>
                                            @foreach($vv['son'] as $vvv)
                                                <a href="#">{{$vvv['cate_name']}}</a>|
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                                <div class="zj_r">
                                    <a href="#"><img src="/style/indexStyle/images/n_img1.jpg" width="236" height="200" /></a>
                                    <a href="#"><img src="/style/indexStyle/images/n_img2.jpg" width="236" height="200" /></a>
                                </div>
                            </div>
                        </li>
                        <?php $i++ ?>
                    @endforeach
                </ul>
            </div>
        </div>
        <!--End 商品分类详情 End-->
        <ul class="menu_r">
            <li><a href="{{url('/')}}">首页</a></li>
            <li><a href="{{url('getCateGoods')}}">全部商品</a></li>
            @foreach($cate as $v)
                <li><a href="javascript:;" cate_id="{{$v->cate_id}}" id="click" >{{$v->cate_name}}</a></li>
            @endforeach
        </ul>
        <div class="m_ad">🐉</div>
    </div>
</div>


<script type="text/javascript" src="/style/indexStyle/js/jquery-1.8.2.min.js"></script>
<script>
    $(document).on('click','#click',function () {
        var cate_id = $(this).attr('cate_id')
        $.get(
            "{{url('/getPCateGoods')}}",
            {cate_id:cate_id},
            function (res) {
                $(".cate_list").html(res);
            }
        ),'json'
    })
</script>
