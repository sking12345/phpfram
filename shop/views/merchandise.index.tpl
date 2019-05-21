<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="Generator" content="ECSHOP v4.0.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Keywords" content="" />
    <meta name="Description" content="" />
    <title>智能相机_数码时尚_配件_ECSHOP演示站 - Powered by ECShop</title>
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="icon" href="animated_favicon.gif" type="image/gif" />
    <link href="shop_static/themes/default/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="shop_static/js/common.js"></script>
</head>

<body>
    <?=snow\tpl::display("index.header.tpl")?>
    <div class="clear0 "></div>
    <div class="goods-home">
        <div class="block box">
            <div id="ur_here">
                <div class="path">
                    <div>当前位置: <a href=".">首页</a> <code>&gt;</code> <a href="category.php?id=19">配件</a> <code>&gt;</code> <a href="category.php?id=24">数码时尚</a> <code>&gt;</code> 智能相机</div>
                </div>
            </div>
        </div>
        <div class="blank"></div>
        <div class="block clearfix">

          <script type="text/html" id="cates">
               <div class="AreaR">
                <div id="goodsInfo" class="clearfix">
                    <div class="imgInfo">
                        <img src="{{infos.img}}" width="100%" alt="智能相机" />
                        <div class="blank5"></div>
                        <div class="blank5"></div>
                    </div>
                    <div class="textInfo">
                        <form  method="post" name="ECS_FORMBUY" id="ECS_FORMBUY">
                            <div class="goods_style_name"> {{infos.name}} </div>
                            <ul>
                                <li class="clearfix">
                                    <dd>
                                        <strong>商品货号：</strong>{{infos.number}} </dd>
                                    <dd class="ddR">
                                        <strong>商品库存：</strong> {{infos.stock_num}} </dd>
                                </li>
                                <li class="clearfix">
                                    <dd>
                                        <strong>商品品牌：</strong>
                                        <a href="brand.php?id=15">{{infos.supplier_id}}</a>
                                    </dd>
                                    <dd class="ddR">
                                        <strong>商品重量：</strong>{{infos.weight}}克 </dd>
                                </li>
                                <li class="clearfix">
                                    
                                    <dd class="ddR">
                                        <strong>商品点击数：</strong>6 </dd>
                                    <dd class="ddR">
                                        <strong>累计销量：</strong>{{infos.sales_num}} </dd>
                                </li>
                                <li class="clearfix">
                                    <dd>
                                        <strong>市场价格：</strong>
                                        <font class="market">￥{{infos.shop_price}}元</font>
                                    </dd>
                         
                                    <dd><strong>注册用户：</strong>
                                        <font class="shop" id="ECS_RANKPRICE_1">￥{{infos.member_price}}元</font>
                                    </dd>
                                    <dd><strong>vip：</strong>
                                        <font class="shop" id="ECS_RANKPRICE_2">￥{{infos.vip_price}}元</font>
                                    </dd>
                                </li>
                                <li class="clearfix">
                                    <dd> <strong>商品总价：</strong>
                                        <font id="ECS_GOODS_AMOUNT" class="shop">
                                          {{infos.details}}
                                        </font>
                                    </dd>
                                    <dd class="ddR">
                                    </dd>
                                </li>
                                <li class="clearfix">
                                    <dd> <strong>购买数量：</strong>
                                        <input name="number" type="text" id="number" value="1" size="4" onblur="changePrice()" style="border:1px solid #ccc; " />
                                    </dd>
                                    <dd class="ddR">
                                        <strong>购买此商品可使用：</strong>
                                        <font class="f4">100 积分</font>
                                    </dd>
                                </li>
                                <li class="padd">
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td class="td1">
                                                 <a href="?ctl=merchandise&act=buy&id={{infos.id}}">
                                                    <img src="shop_static/themes/default/images/buybtn1.png" />
                                                </a>
                                              
                                      
                                            </td>
                                            <td class="td2"><a href="javascript:collect(72)"><img src="shop_static/themes/default/images/bnt_colles.gif" /></a></td>
                                           
                                        </tr>
                                    </table>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
                <div class="blank"></div>
                <div class="box clearfix">
                    <div class="box_1 goods-boxg">
                        <div class="box_top">
                            <div id="com_b" class="history clearfix">
                                <h2>商品描述：</h2>
                                <h2 class="h2bg">商品属性</h2>
                            </div>
                        </div>
                        <div id="com_v" class="boxCenterList RelaArticle">
                          {{infos.remarks}}
                        </div>
                        <div id="com_h">
                            <blockquote>
                                <p>&nbsp;<img src="shop_static/http://cbu2.test.shopex123.com/images//20160510/5984c3f800d7ef3c.jpg" alt="" /></p>
                            </blockquote>
                            <blockquote>
                                <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#dddddd">
                                </table>
                            </blockquote>
                        </div>
                    </div>
                </div>
       
                <div class="blank5"></div>
            </div>
          </script>
        </div>
        <div class="blank5"></div>
        <div class="blank"></div>
    </div>
    <div id="msg" class="hidden" style="display: none;">
        <?=snow\tpl::get_json_assign()?>
    </div>
     <script type="text/javascript" src="./shop_static/js/jquery.js"></script>
     <script src="public/js/template-web.js"></script>
    <script type="text/javascript" src="public/js/main.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            rendering('msg', true);
        });
    </script>

</body>

</html>