<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="Generator" content="ECSHOP v4.0.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Keywords" content="ECSHOP演示站" />
    <meta name="Description" content="ECSHOP演示站" />
    <title>xshop</title>
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="icon" href="animated_favicon.gif" type="image/gif" />
    <link href="shop_static/themes/default/style.css" rel="stylesheet" type="text/css" />
    <link rel="alternate" type="application/rss+xml" title="RSS|ECSHOP演示站 - Powered by ECShop" href="feed.php" />
    <link rel="stylesheet" type="text/css" href="shop_static/themes/default/images/swiper.min.css">
    <script language='javascript' src='./shop_static/themes/default/js/swiper.min.js' type='text/javascript' charset='utf-8'></script>
    <script type="text/javascript" src="./shop_static/js/common.js"></script>
    <script type="text/javascript" src="./shop_static/js/index.js"></script>
</head>
<body>
    <script type="text/javascript">
    var process_request = "正在处理您的请求...";
    </script>
    <div class="top-bar">
        <div class="fd_top fd_top1">
            <div class="bar-left">
                <div class="top_menu1">
                    <script type="text/javascript" src="shop_static/js/transport.js"></script>
                    <script type="text/javascript" src="shop_static/js/utils.js"></script>
                    <font id="ECS_MEMBERZONE">
                        <div id="append_parent"></div>
                        欢迎光临本店<a href="user.php">请登录 <strong></strong></a>&nbsp;|&nbsp;&nbsp;<a href="user.php?act=register">免费注册</a>
                    </font>
                </div>
            </div>
            <div class="bar-cart">
                <div class="fl cart-yh">
                    <a href="user.php" class="">用户中心</a>
                </div>
                <div class="cart" id="ECS_CARTINFO"> <a href="flow.php" title="查看购物车">购物车(1)</a> </div>
            </div>
        </div>
    </div>
    <div class="nav-menu">
        <div class="wrap">
            <div class="logo"><a href="index.php" name="top"><img src="shop_static/themes/default/images/logo.gif" /></a></div>
            <div id="mainNav" class="clearfix maxmenu">
                <div class="m_left">
                    <ul>
                        <li><a href="index.php" class="cur">首页</a></li>
                        <li><a href="category.php?id=16">服装</a></li>
                        <li><a href="category.php?id=22">移动电源</a></li>
                        <li><a href="category.php?id=25">数码时尚</a></li>
                        <li><a href="category.php?id=26">家用电器</a></li>
                        <li><a href="category.php?id=25">数码时尚</a></li>
                    </ul>
                </div>
            </div>
            <div class="serach-box">
                <form id="searchForm" name="searchForm" method="get" action="search.php" onSubmit="return checkSearchForm()" class="f_r">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="135"><input name="keywords" type="text" id="keyword" value="" class="B_input" /></td>
                            <td><input name="imageField" type="submit" value="搜索" class="go" style="cursor:pointer;" /></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <div class="clear0 "></div>
    <script>
    if (Object.prototype.toJSONString) {
        var oldToJSONString = Object.toJSONString;
        Object.prototype.toJSONString = function() {
            if (arguments.length > 0) {
                return false;
            } else {
                return oldToJSONString.apply(this, arguments);
            }
        }
    }
    </script>
    <div class="indexpage clearfix">
        <div class="index-cat">
            <div class="category_info">
                <div id="category_tree">
                    <div class="cat-box">
                        <div class="cat1"><a href="category.php?id=26">家用电器</a></div>
                        <div class="cat2-box">
                            <div class="cat2 clearfix">
                                <a class="cat2-link" href="category.php?id=27">大家电</a>
                                <div class="cat3-block"></div>
                                <div class="cat3-box">
                                    <a href="category.php?id=28">平板电脑</a>&nbsp;&nbsp;
                                    <a href="category.php?id=29">家用空调</a>&nbsp;&nbsp;
                                    <a href="category.php?id=30">家电配件</a>&nbsp;&nbsp;
                                    <a href="category.php?id=31">洗衣机</a>&nbsp;&nbsp;
                                    <a href="category.php?id=32">冰箱</a>&nbsp;&nbsp;
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cat-box">
                        <div class="cat1"><a href="category.php?id=25">数码时尚</a></div>
                    </div>
                    <div class="cat-box">
                        <div class="cat1"><a href="category.php?id=18">智能硬件</a></div>
                    </div>
                    <div class="cat-box">
                        <div class="cat1"><a href="category.php?id=22">移动电源</a></div>
                    </div>
                    <div class="cat-box">
                        <div class="cat1"><a href="category.php?id=1">手机类型</a></div>
                        <div class="cat2-box">
                            <div class="cat2 clearfix">
                                <a class="cat2-link" href="category.php?id=3">小型手机</a>
                            </div>
                            <div class="cat2 clearfix">
                                <a class="cat2-link" href="category.php?id=4">3G手机</a>
                            </div>
                        </div>
                    </div>
                    <div class="cat-box">
                        <div class="cat1"><a href="category.php?id=6">手机</a></div>
                        <div class="cat2-box">
                            <div class="cat2 clearfix">
                                <a class="cat2-link" href="category.php?id=8">耳机</a>
                            </div>
                            <div class="cat2 clearfix">
                                <a class="cat2-link" href="category.php?id=9">电池</a>
                            </div>
                        </div>
                    </div>
                    <div class="cat-box">
                        <div class="cat1"><a href="category.php?id=12">充值卡</a></div>
                    </div>
                    <div class="cat-box">
                        <div class="cat1"><a href="category.php?id=16">服装</a></div>
                    </div>
                    <div class="cat-box">
                        <div class="cat1"><a href="category.php?id=19">配件</a></div>
                        <div class="cat2-box">
                            <div class="cat2 clearfix">
                                <a class="cat2-link" href="category.php?id=24">数码时尚</a>
                            </div>
                            <div class="cat2 clearfix">
                                <a class="cat2-link" href="category.php?id=20">保护壳</a>
                            </div>
                        </div>
                    </div>
                    <div class="cat-box">
                        <div class="cat1"><a href="category.php?id=33">昂天</a></div>
                        <div class="cat2-box">
                            <div class="cat2 clearfix">
                                <a class="cat2-link" href="category.php?id=34">xxx</a>
                            </div>
                        </div>
                    </div>
                    <div class="clear0"></div>
                </div>
                <div class="clear0"></div>
            </div>
        </div>
        <div class="index-banner">
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
                    <div class="swiper-slide"></div>
                    <div class="swiper-slide"></div>
                    <div class="swiper-slide"></div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <script>
            var swiper = new Swiper('.swiper1', {
                pagination: '.swiper-pagination',
                nextButton: '.swiper-button-next',
                prevButton: '.swiper-button-prev',
                paginationClickable: true,
                spaceBetween: 0,
                centeredSlides: true,
                autoplay: 4000,
                loop: true,
                autoplayDisableOnInteraction: false
            });
            </script>
        </div>
    </div>
    <div class="indexpage clearfix index-ad">
        <div class="ad-tg">
        </div>
        <div class="ad-lb">
            <style>
            .swiper-container.swiper2 {
                width: 100%;
                height: auto;
                margin-left: auto;
                margin-right: auto;
                overflow: hidden;
            }

            .swiper2 .swiper-slide {
                text-align: center;
                font-size: 18px;
                background: #fff;
                height: 200px;

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
            <div class="swiper-container swiper2">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"></div>
                    <div class="swiper-slide"></div>
                    <div class="swiper-slide"></div>
                    <div class="swiper-slide"></div>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <script>
            var swiper = new Swiper('.swiper2', {
                nextButton: '.swiper-button-next',
                prevButton: '.swiper-button-prev',
                slidesPerView: 4,
                paginationClickable: true,
                spaceBetween: 0,
                loop: true
            });
            </script>
        </div>
    </div>
    
 
 
</body>

</html>