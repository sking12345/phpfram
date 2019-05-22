<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="Generator" content="ECSHOP v4.0.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Keywords" content="" />
    <meta name="Description" content="" />
    <title>购物流程_ECSHOP演示站 - Powered by ECShop</title>
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="icon" href="animated_favicon.gif" type="image/gif" />
    <link href="shop_static/themes/default/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="shop_static/js/common.js"></script>
    <script type="text/javascript" src="shop_static/js/shopping_flow.js"></script>
</head>

<body>
    <?=snow\tpl::display("index.header.tpl")?>
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
    <div class="block box">
        <div id="ur_here">
            <div class="path">
                <div>当前位置: <a href=".">首页</a> <code>&gt;</code> 购物流程</div>
            </div>
        </div>
    </div>
    <div class="blank"></div>
    <div class="block">
        <script type="text/html" id="infos">
            <div class="flowBox">
            <h6><span>商品列表</span></h6>
            <form id="formCart" name="formCart" method="post">
                <table width="99%" align="center" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                    <tr>
                        <th bgcolor="#ffffff" >商品名称</th>
                        <th bgcolor="#ffffff">图片</th>
                        <th bgcolor="#ffffff">价格</th>
                       
                        <th bgcolor="#ffffff">购买数量</th>
                        <th bgcolor="#ffffff">小计</th>
                        <th bgcolor="#ffffff">操作</th>
                    </tr>
                    {{each list as item i}}
                     <tr>
                        <td  bgcolor="#ffffff"  align="center">{{item.name}}</td>
                        <td  bgcolor="#ffffff" align="center"><img src="{{item.img}}" width="50x"></td>
                        <td bgcolor="#ffffff"  align="center">¥{{item.price}}</td>
                     
                        <td bgcolor="#ffffff"  align="center">{{item.number}}</td>
                        <td bgcolor="#ffffff"  align="center">¥{{item.total_price}}</td>
                        <td  bgcolor="#ffffff"  align="center">
                          <a href="?ctl=merchandise&act=del_merchandise&id={{item.id}}">删除</a>
                        </td>
                    </tr>
                    {{/each}}
                </table>
                <table width="99%" align="center" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                    <tr>
                        <td bgcolor="#ffffff">
                            购物金额小计 ￥0.00元</td>
                        <td align="right" bgcolor="#ffffff">
                            <input type="button" value="清空购物车" class="bnt_blue_1" 
                            onclick="location.href='?ctl=merchandise&act=clear_cart'" 
                            />
                            <a href="">
                              <input name="submit" type="submit" class="bnt_blue_1" value="更新购物车" />
                            </a>
                        </td>
                    </tr>
                </table>
                <input type="hidden" name="step" value="update_cart" />
            </form>
            <table width="99%" align="center" border="0" cellpadding="5" cellspacing="0" bgcolor="#dddddd">
                <tr>
                    <td bgcolor="#ffffff">
                      <a href="?ctl=index&act=index1">
                      <img src="shop_static/themes/default/images/continue.gif" alt="continue" />
                    </a>
                  </td>
                    <td bgcolor="#ffffff" align="right">
                      <a href="?ctl=merchandise&act=checkout">
                        <img src="shop_static/themes/default/images/checkout.gif" alt="checkout" />
                      </a>
                    </td>
                </tr>
            </table>
        </div>

        <div class="blank5"></div>
      </script>
    </div>
    <div class="blank5"></div>
    <div class="blank"></div>
    <?=snow\tpl::display("index.foot.tpl")?>
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







