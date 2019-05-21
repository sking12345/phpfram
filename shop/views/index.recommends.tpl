<div class="index-body">
<div class="indexpage">
    <script type="text/html" id="recommends">
    {{each recommends as item i}}
    <div class="body-goods">
        <div class="goods-title" style="margin-left:14%">{{item.cat_name}}</div>
        <div class="clearfix">
            <div class="goods-right" style="margin-left:14%;width: 75%;background:beige;padding:10px">
               
                {{each merchandise as item1 i1}}
                 <a class="goodsItem" href="?ctl=merchandise&act=index&id={{item1.id}}">
                        <div class="img-box"><img src="{{item1.img}}" alt="{{item1.name}}" class="goodsimg" /></div>
                        <div class="goods-brief"></div>
                        <div class="gos-title">{{item1.name}}</div>
                        <div class="prices">
                            <font class="shop_s"><b>￥{{item1.shop_price}}元</b></font>
                        </div>
                    </a>
                {{/each}} 
                <div class="clear0"></div>
            </div>
        </div>
    </div>
    {{/each}}
    </script>
</div>
</div>