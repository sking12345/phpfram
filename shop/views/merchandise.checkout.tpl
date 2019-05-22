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
        <form  method="post" name="theForm" id="theForm" >
           <?=snow\tpl::from_token()?>
            <div class="blank"></div>
            <div class="flowBox">
                <h6><span>收货人信息</span><a href="flow.php?step=consignee" class="f6">修改</a></h6>
                <table width="99%" align="center" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                    <tr>
                        <td bgcolor="#ffffff">收货人姓名:</td>
                        <td bgcolor="#ffffff">12345</td>
                        <td bgcolor="#ffffff">电子邮件地址:</td>
                        <td bgcolor="#ffffff">1281099078@qq.com</td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff">详细地址:</td>
                        <td bgcolor="#ffffff">123456 </td>
                        <td bgcolor="#ffffff">邮政编码:</td>
                        <td bgcolor="#ffffff"></td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff">电话:</td>
                        <td bgcolor="#ffffff">123456 </td>
                        <td bgcolor="#ffffff">手机:</td>
                        <td bgcolor="#ffffff"></td>
                    </tr>
                </table>
            </div>

            <div class="blank"></div>
            <div class="flowBox">
                <h6><span>支付方式</span></h6>
                <table width="99%" align="center" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd" id="paymentTable">
                    <tr>
                        <th width="5%" bgcolor="#ffffff">&nbsp;</th>
                        <th width="20%" bgcolor="#ffffff">名称</th>
                        <th bgcolor="#ffffff">订购描述</th>
                        <th bgcolor="#ffffff" width="15%">手续费</th>
                    </tr>
                    <tr>
                        <td rowspan=2 valign="middle" bgcolor="#ffffff">
                            <input type="radio" id="yunqi_payment" name="payment" value="4" isCod="0" onclick="selectPayment(this)" /></td>
                        <td class="list-tit" valign="top" bgcolor="#ffffff">
                            <strong>
                                <font color="#FF0000">天工收银</font> <i style="display:inline-block;width: 70px ;text-align: center" id="payMethod">（支付宝）</i>
                            </strong>
                        </td>
                        <td valign="top" bgcolor="#ffffff">
                            <font color="#FF0000">天工收银是上海商派2015年正式推出的专业集成支付平台，致力于为各类用户提供融合、便捷、安全的场景支付服务。</font>
                        </td>
                        <td align="right" bgcolor="#ffffff" valign="top">￥0.00元</td>
                    </tr>
                    <tr>
                        <td align="left" bgcolor="#ffffff" valign="top" colspan=3>
                            <span class="item">
                                <input type="radio" id="alipay" name="yunqi_paymethod" value="alipay" checked onclick="checkIpt(this);">
                                <label for="paybal" class="alipay-image"></label>
                            </span>
                            <span class="item">
                                <input type="radio" id="wxpay" name="yunqi_paymethod" value="wxpay" onclick="checkIpt(this);">
                                <label for="wechat" class="wechat-image"></label>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" bgcolor="#ffffff"><input type="radio" name="payment" value="2" isCod="0" onclick="selectPayment(this)" /></td>
                        <td valign="top" bgcolor="#ffffff"><strong>银行汇款/转帐</strong></td>
                        <td valign="top" bgcolor="#ffffff">银行名称
                            收款人信息：全称 ××× ；帐号或地址 ××× ；开户行 ×××。
                            注意事项：办理电汇时，请在电汇单“汇款用途”一栏处注明您的订单号。</td>
                        <td align="right" bgcolor="#ffffff" valign="top">￥0.00元</td>
                    </tr>
                    <tr>
                        <td valign="top" bgcolor="#ffffff"><input type="radio" name="payment" value="3" isCod="1" onclick="selectPayment(this)" disabled="true" /></td>
                        <td valign="top" bgcolor="#ffffff"><strong>货到付款</strong></td>
                        <td valign="top" bgcolor="#ffffff">开通城市：×××
                            货到付款区域：×××</td>
                        <td align="right" bgcolor="#ffffff" valign="top"><span id="ECS_CODFEE">￥0.00元</span></td>
                    </tr>
                </table>
            </div>
       
     
            <div class="blank"></div>
            <div class="flowBox">
                <h6><span>费用总计</span></h6>
                <div id="ECS_ORDERTOTAL">
                    <table width="99%" align="center" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                        <tr>
                            <td align="right" bgcolor="#ffffff">
                                商品总价: <font class="f4_b">￥<?=snow\tpl::get_assign("total_price")?>元</font>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" bgcolor="#ffffff"> 应付款金额: <font class="f4_b">￥<?=snow\tpl::get_assign("total_price")?>元</font>
                            </td>
                        </tr>
                    </table>
                </div>
                <div align="center" style="margin:8px auto;">
                    <input type="image" src="shop_static/themes/default/images/bnt_subOrder.gif" />
                    <input type="hidden" name="step" value="done" />
                </div>
            </div>
        </form>
    </div>
    <div class="blank5"></div>
    <div class="blank"></div>
    <?=snow\tpl::display("index.foot.tpl")?>
</body>


</html>