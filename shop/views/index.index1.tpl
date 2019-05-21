<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="Generator" content="ECSHOP v4.0.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>xshop</title>
    <link href="shop_static/themes/default/style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="shop_static/themes/default/images/swiper.min.css">
    <link href="shop_static/css/style.css" rel="stylesheet" type="text/css" />

</head>
<body>
    <div class="top-bar">
        <div class="fd_top fd_top1">
            <div class="bar-left">
                <div class="top_menu1">
                    <font id="ECS_MEMBERZONE">
                        <div id="append_parent"></div>
                        欢迎光临本店<a href="?ctl=user&act=login">请登录 <strong></strong></a>
                        &nbsp;|&nbsp;&nbsp;
                        <a href="?ctl=user&act=register">免费注册</a>
                    </font>
                </div>
            </div>
            <div class="bar-cart">
                <div class="fl cart-yh">
                    <a href="?ctl=user&act=index" class="">用户中心</a>
                </div>
                <div class="cart" id="ECS_CARTINFO"> <a href="flow.php" title="查看购物车">购物车(1)</a> </div>
            </div>
        </div>
    </div>
    <div class="nav-menu">
        <div class="wrap">
            <div class="logo" style="margin-top:30px;margin-left:14%">
                <a href="index.php" name="top"><img src="shop_static/themes/default/images/logo.gif"></a>
            </div>
            <div class="serach-box" style="width: 50%">
                <form  name="searchForm" method="get" class="w100" style="background:#655d5dcc">
                     <input type="text" name="keyword" style="width:80%;height: 30px;border: 2px solid #655d5dcc">
                     <button style="height: 35px;border:0px; width:18%;background:#655d5dcc;color: #fff;font-size: 14px">搜索</button>
                </form>
            </div>
        </div>
    </div>
    <div class="indexpage clearfix"  style="margin-left:14%;width: 80%;overflow: hidden;">
        
        <div class="index-cat" >
             <script type="text/html" id="cates">
            <div class="category_info">
                <div id="category_tree" >
                   
                    {{each cates as item i}}
                    <div class="cat-box">
                        <div class="cat1"><a  href="?ctl=category&act=index&id={{item.id}}">{{item.cat_name}}</a></div>
                        <div class="cat2-box">
                            {{if item.childers}}
                            {{each item.childers as item1 i1}}
                            <div class="cat2 clearfix">
                                <a class="cat2-link"  href="?ctl=category&act=index&id={{item1.id}}">{{item1.cat_name}}</a>
                                <div class="cat3-block"></div>
                                <div class="cat3-box">
                                    {{each item1.childers as item2 i2}}
                                         <a href="?ctl=category&act=index&id={{item2.id}}">{{item2.cat_name}}</a>&nbsp;&nbsp;
                                    {{/each}}
                                </div>
                            </div>
                            {{/each}}
                            {{/if}}

                        </div>
                    </div>
                    {{/each}}
                    <div class="clear0"></div>
                </div>
                <div class="clear0"></div>
            </div>
             </script>
        </div>
        <div class="index-banner" style="width: 70%">
            <style>
            .swiper-container {
                width: 100%;
                height: 100%;
            }

            .swiper-slide {
                text-align: center;
                font-size: 18px;
                background: #fff;
                /* Center slide text vertically */
                display: -webkit-box;
                display: -ms-flexbox;
                display: -webkit-flex;
                display: flex;
                -webkit-box-pack: center;
                -ms-flex-pack: center;
                -webkit-justify-content: center;
                justify-content: center;
                -webkit-box-align: center;
                -ms-flex-align: center;
                -webkit-align-items: center;
                align-items: center;
            }
            </style>
            <div class="swiper-container swiper1">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img height="100%" width="100%" src="http://img3.imgtn.bdimg.com/it/u=1690699292,1481547313&fm=26&gp=0.jpg"></div>
                    <div class="swiper-slide">
                        <img height="100%" width="100%" src="http://b-ssl.duitang.com/uploads/item/20182/21/2018221142159_MZ33z.jpeg">
                    </div>
                    <div class="swiper-slide">
                         <img height="100%" width="100%" src="http://b-ssl.duitang.com/uploads/item/201208/22/20120822155433_ZLnhS.jpeg">
                    </div>
                     <div class="swiper-slide">
                         <img height="100%" width="100%" src="http://img.zhiribao.com/upload/images/201607/6/6b0152a5b29f309f3f92f52adc6cd017eae73133.jpg">
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>

    <?=snow\tpl::run_controller("index","recommends")?>
     <?=snow\tpl::display("index.foot.tpl")?>
       
    <script type="text/javascript" src="./shop_static/js/jquery.js"></script>
    <script type="text/javascript">
            $(function(){
                var i=1;
                var swiper_obj =  $(".swiper-slide");
                var swiper_len = swiper_obj.length;
                window.setInterval(function(){
                    swiper_obj.hide();
                    swiper_obj.eq(i).show();
                    i++;
                    i=i%swiper_len;
                },5000);
            })
    </script>
    <div id="msg" class="hidden" style="display: none;">
        <?=snow\tpl::get_json_assign()?>
    </div>
     <script src="public/js/template-web.js"></script>
    <script type="text/javascript" src="public/js/main.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            rendering('msg', true);
        });
        </script>

</body>
</html>











