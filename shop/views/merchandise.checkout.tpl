
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
<link href="themes/default/style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/common.js"></script><script type="text/javascript" src="js/shopping_flow.js"></script></head>
<body>

<script type="text/javascript">
var process_request = "正在处理您的请求...";
</script>
<div class="top-bar">
  <div class="fd_top fd_top1">
    <div class="bar-left">
          <div class="top_menu1"> <script type="text/javascript" src="js/transport.js"></script><script type="text/javascript" src="js/utils.js"></script> <font id="ECS_MEMBERZONE"><div id="append_parent"></div>
 欢迎光临本店<a href="user.php">请登录 <strong></strong></a>&nbsp;|&nbsp;&nbsp;<a href="user.php?act=register">免费注册</a>  </font> </div>
    </div>
    <div class="bar-cart">
      <div class="fl cart-yh">
        <a href="user.php" class="">用户中心</a>
      </div>
             <div class="cart" id="ECS_CARTINFO"> <a href="flow.php" title="查看购物车">购物车(2)</a> </div>
    </div>
  </div>
</div>
<div class="nav-menu">
  <div class="wrap">
    <div class="logo"><a href="index.php" name="top"><img src="themes/default/images/logo.gif" /></a></div>
    <div id="mainNav" class="clearfix maxmenu">
      <div class="m_left">
      <ul>
        <li><a href="index.php" class="cur">首页</a></li>
                        <li><a href="category.php?id=16" 
        
                    >服装</a></li>
                                        <li><a href="category.php?id=22" 
        
                    >移动电源</a></li>
                                        <li><a href="category.php?id=25" 
        
                    >数码时尚</a></li>
                                        <li><a href="category.php?id=26" 
        
                    >家用电器</a></li>
                                        <li><a href="category.php?id=25" 
        
                    >数码时尚</a></li>
                              </ul>
      </div>
    </div>
    <div class="serach-box">
      <form id="searchForm" name="searchForm" method="get" action="search.php" onSubmit="return checkSearchForm()" class="f_r">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="135"><input name="keywords" type="text" id="keyword" value="" class="B_input"  /></td>
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
  <div class="path"><div>当前位置: <a href=".">首页</a> <code>&gt;</code> 购物流程</div></div> </div>
</div>

<div class="blank"></div>
<div class="block">
  
  
  

        
                <form action="flow.php" method="post" name="theForm" id="theForm" onsubmit="return checkOrderForm(this)">
        <script type="text/javascript">
        var flow_no_payment = "您必须选定一个支付方式。";
        var flow_no_shipping = "您必须选定一个配送方式。";
        </script>
        <div class="flowBox">
        <h6><span>商品列表</span><a href="flow.php" class="f6">修改</a></h6>
        <table width="99%" align="center" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
            <tr>
              <th bgcolor="#ffffff">商品名称</th>
              <th bgcolor="#ffffff">属性</th>
                            <th bgcolor="#ffffff">市场价</th>
                            <th bgcolor="#ffffff">本店价</th>
              <th bgcolor="#ffffff">购买数量</th>
              <th bgcolor="#ffffff">小计</th>
            </tr>
                        <tr>
              <td bgcolor="#ffffff">
                        <a href="goods.php?id=72" target="_blank" class="f6">智能相机</a>
                                                  </td>
              <td bgcolor="#ffffff"></td>
                            <td align="right" bgcolor="#ffffff">￥178.79元</td>
                            <td bgcolor="#ffffff" align="right">￥149.00元</td>
              <td bgcolor="#ffffff" align="right">2</td>
              <td bgcolor="#ffffff" align="right">￥298.00元</td>
            </tr>
                                    <tr>
              <td bgcolor="#ffffff" colspan="7">
                            购物金额小计 ￥298.00元，比市场价 ￥357.58元 节省了 ￥59.58元 (17%)              </td>
            </tr>
                      </table>
      </div>
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
    <h6><span>配送方式</span></h6>
    <table width="99%" align="center" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd" id="shippingTable">
            <tr>
              <th bgcolor="#ffffff" width="5%">&nbsp;</th>
              <th bgcolor="#ffffff" width="25%">名称</th>
              <th bgcolor="#ffffff">订购描述</th>
              <th bgcolor="#ffffff" width="15%">费用</th>
              <th bgcolor="#ffffff" width="15%">免费额度</th>
              <th bgcolor="#ffffff" width="15%">保价费用</th>
            </tr>
                        <tr>
              <td bgcolor="#ffffff" valign="top"><input name="shipping" type="radio" value="5"  supportCod="0" insure="0" onclick="selectShipping(this)" />
              </td>
              <td bgcolor="#ffffff" valign="top"><strong>申通快递</strong></td>
              <td bgcolor="#ffffff" valign="top">江、浙、沪地区首重为15元/KG，其他地区18元/KG， 续重均为5-6元/KG， 云南地区为8元</td>
              <td bgcolor="#ffffff" align="right" valign="top">￥15.00元</td>
              <td bgcolor="#ffffff" align="right" valign="top">￥0.00元</td>
              <td bgcolor="#ffffff" align="right" valign="top">不支持保价</td>
            </tr>
                        <tr>
              <td bgcolor="#ffffff" valign="top"><input name="shipping" type="radio" value="6"  supportCod="0" insure="0" onclick="selectShipping(this)" />
              </td>
              <td bgcolor="#ffffff" valign="top"><strong>邮局平邮</strong></td>
              <td bgcolor="#ffffff" valign="top">邮局平邮的描述内容。</td>
              <td bgcolor="#ffffff" align="right" valign="top">￥3.50元</td>
              <td bgcolor="#ffffff" align="right" valign="top">￥50000.00元</td>
              <td bgcolor="#ffffff" align="right" valign="top">不支持保价</td>
            </tr>
                        <tr>
              <td colspan="6" bgcolor="#ffffff" align="right"><label for="ECS_NEEDINSURE">
                <input name="need_insure" id="ECS_NEEDINSURE" type="checkbox"  onclick="selectInsure(this.checked)" value="1"  disabled="true"  />
                配送是否需要保价 </label></td>
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
                <input type="radio" id="yunqi_payment" name="payment" value="4"  isCod="0" onclick="selectPayment(this)" /></td>
              <td class="list-tit" valign="top" bgcolor="#ffffff">
                <strong><font color="#FF0000">天工收银</font> <i style="display:inline-block;width: 70px ;text-align: center" id="payMethod">（支付宝）</i></strong>
                
              </td>
              <td valign="top" bgcolor="#ffffff"><font color="#FF0000">天工收银是上海商派2015年正式推出的专业集成支付平台，致力于为各类用户提供融合、便捷、安全的场景支付服务。</font></td>
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
              <td valign="top" bgcolor="#ffffff"><input type="radio" name="payment" value="2"  isCod="0" onclick="selectPayment(this)" /></td>
              <td valign="top" bgcolor="#ffffff"><strong>银行汇款/转帐</strong></td>
              <td valign="top" bgcolor="#ffffff">银行名称
收款人信息：全称 ××× ；帐号或地址 ××× ；开户行 ×××。
注意事项：办理电汇时，请在电汇单“汇款用途”一栏处注明您的订单号。</td>
              <td align="right" bgcolor="#ffffff" valign="top">￥0.00元</td>
            </tr>
                                    
                        <tr>
              <td valign="top" bgcolor="#ffffff"><input type="radio" name="payment" value="3"  isCod="1" onclick="selectPayment(this)" disabled="true"/></td>
              <td valign="top" bgcolor="#ffffff"><strong>货到付款</strong></td>
              <td valign="top" bgcolor="#ffffff">开通城市：×××
货到付款区域：×××</td>
              <td align="right" bgcolor="#ffffff" valign="top"><span id="ECS_CODFEE">￥0.00元</span></td>
            </tr>
                                  </table>
    </div>
        <div class="blank"></div>
                    <div class="flowBox">
          <h6><span>商品包装</span></h6>
          <table width="99%" align="center" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd" id="packTable">
            <tr>
              <th width="5%" scope="col" bgcolor="#ffffff">&nbsp;</th>
              <th width="35%" scope="col" bgcolor="#ffffff">名称</th>
              <th width="22%" scope="col" bgcolor="#ffffff">价格</th>
              <th width="22%" scope="col" bgcolor="#ffffff">免费额度</th>
              <th scope="col" bgcolor="#ffffff">图片</th>
            </tr>
            <tr>
              <td valign="top" bgcolor="#ffffff"><input type="radio" name="pack" value="0" checked="true" onclick="selectPack(this)" /></td>
              <td valign="top" bgcolor="#ffffff"><strong>不要包装</strong></td>
              <td valign="top" bgcolor="#ffffff">&nbsp;</td>
              <td valign="top" bgcolor="#ffffff">&nbsp;</td>
              <td valign="top" bgcolor="#ffffff">&nbsp;</td>
            </tr>
                        <tr>
              <td valign="top" bgcolor="#ffffff"><input type="radio" name="pack" value="1"  onclick="selectPack(this)" />
              </td>
              <td valign="top" bgcolor="#ffffff"><strong>精品包装</strong></td>
              <td valign="top" bgcolor="#ffffff" align="right">￥5.00元</td>
              <td valign="top" bgcolor="#ffffff" align="right">￥800.00元</td>
              <td valign="top" bgcolor="#ffffff" align="center">
                                    <a href="data/packimg/1242108360911825791.jpg" target="_blank" class="f6">查看</a>
                                 </td>
            </tr>
                      </table>
       </div>
             <div class="blank"></div>
          
                    <div class="flowBox">
          <h6><span>祝福贺卡</span></h6>
          <table width="99%" align="center" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd" id="cardTable">
            <tr>
              <th bgcolor="#ffffff" width="5%" scope="col">&nbsp;</th>
              <th bgcolor="#ffffff" width="35%" scope="col">名称</th>
              <th bgcolor="#ffffff" width="22%" scope="col">价格</th>
              <th bgcolor="#ffffff" width="22%" scope="col">免费额度</th>
              <th bgcolor="#ffffff" scope="col">图片</th>
            </tr>
            <tr>
              <td bgcolor="#ffffff" valign="top"><input type="radio" name="card" value="0" checked="true" onclick="selectCard(this)" /></td>
              <td bgcolor="#ffffff" valign="top"><strong>不要贺卡</strong></td>
              <td bgcolor="#ffffff" valign="top">&nbsp;</td>
              <td bgcolor="#ffffff" valign="top">&nbsp;</td>
              <td bgcolor="#ffffff" valign="top">&nbsp;</td>
            </tr>
                        <tr>
              <td valign="top" bgcolor="#ffffff"><input type="radio" name="card" value="1"  onclick="selectCard(this)"  />
              </td>
              <td valign="top" bgcolor="#ffffff"><strong>祝福贺卡</strong></td>
              <td valign="top" align="right" bgcolor="#ffffff">￥5.00元</td>
              <td valign="top" align="right" bgcolor="#ffffff">￥1000.00元</td>
              <td valign="top" align="center" bgcolor="#ffffff">
                                    <a href="data/cardimg/1242108754847457261.jpg" target="_blank" class="f6">查看</a>
                                  </td>
            </tr>
                        <tr>
              <td bgcolor="#ffffff"></td>
              <td bgcolor="#ffffff" valign="top"><strong>祝福语:</strong></td>
              <td bgcolor="#ffffff" colspan="3"><textarea name="card_message" cols="60" rows="3" style="width:auto; border:1px solid #ccc;"></textarea></td>
            </tr>
          </table>
        </div>
                <div class="blank"></div>
        
      <div class="flowBox">
    <h6><span>其它信息</span></h6>
      <table width="99%" align="center" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                                                <tr>
              <td bgcolor="#ffffff"><strong>使用红包:</strong></td>
              <td bgcolor="#ffffff">
                选择已有红包                <select name="bonus" onchange="changeBonus(this.value)" id="ECS_BONUS" style="border:1px solid #ccc;">
                  <option value="0" selected>请选择</option>
                                  </select>

                或者输入红包序列号                <input name="bonus_sn" type="text" class="inputBg" size="15" value="" />
                <input name="validate_bonus" type="button" class="bnt_blue_1" value="验证红包" onclick="validateBonus(document.forms['theForm'].elements['bonus_sn'].value)" style="vertical-align:middle;" />
              </td>
            </tr>
                                    <tr>
              <td bgcolor="#ffffff"><strong>开发票:</strong>
                <input name="need_inv" type="checkbox"  class="input" id="ECS_NEEDINV" onclick="changeNeedInv()" value="1"  />
              </td>
              <td bgcolor="#ffffff">
                                发票类型                <select name="inv_type" id="ECS_INVTYPE" disabled="true" onchange="changeNeedInv()" style="border:1px solid #ccc;">
                <option value="1">1 [1%]</option><option value="2">2 [1.5%]</option></select>
                                发票抬头                <input name="inv_payee" type="text"  class="input" id="ECS_INVPAYEE" size="20" disabled="true" value="" onblur="changeNeedInv()" />
                发票内容              <select name="inv_content" id="ECS_INVCONTENT" disabled="true"  onchange="changeNeedInv()" style="border:1px solid #ccc;">

                <option value="demo">demo</option>
                </select></td>
            </tr>
                        <tr>
              <td valign="top" bgcolor="#ffffff"><strong>订单附言:</strong></td>
              <td bgcolor="#ffffff"><textarea name="postscript" cols="80" rows="3" id="postscript" style="border:1px solid #ccc;"></textarea></td>
            </tr>
                        <tr>
              <td bgcolor="#ffffff"><strong>缺货处理:</strong></td>
              <td bgcolor="#ffffff">                <label>
                <input name="how_oos" type="radio" value="0" checked onclick="changeOOS(this)" />
                等待所有商品备齐后再发</label>
                                <label>
                <input name="how_oos" type="radio" value="1"  onclick="changeOOS(this)" />
                取消订单</label>
                                <label>
                <input name="how_oos" type="radio" value="2"  onclick="changeOOS(this)" />
                与店主协商</label>
                              </td>
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
      商品总价: <font class="f4_b">￥298.00元</font>
                                              </td>
  </tr>
    <tr>
    <td align="right" bgcolor="#ffffff"> 应付款金额: <font class="f4_b">￥298.00元</font>
    	</td>
  </tr>
</table>
</div>           <div align="center" style="margin:8px auto;">
            <input type="image" src="themes/default/images/bnt_subOrder.gif" />
            <input type="hidden" name="step" value="done" />
            </div>
    </div>
    </form>
        
                



</div>
<div class="blank5"></div>


<div class="blank"></div>
<div class="foot-body">
  <div class="bads"><img src="themes/default/images/bottom.jpg"></div>
  <div class="clear10"></div>
  
     <div class="foot-help">
                      <dl>
          <dt class="xs-1">新手上路 </dt>
                      <dd><a href="article.php?id=9" target="_blank" title="售后流程">售后流程</a></dd>
                    <dd><a href="article.php?id=10" target="_blank" title="购物流程">购物流程</a></dd>
                    <dd><a href="article.php?id=11" target="_blank" title="订购方式">订购方式</a></dd>
           
        </dl>
         
                        <dl>
          <dt class="xs-2">手机常识 </dt>
                      <dd><a href="article.php?id=12" target="_blank" title="如何分辨原装电池">如何分辨原装电池</a></dd>
                    <dd><a href="article.php?id=13" target="_blank" title="如何分辨水货手机 ">如何分辨水货手机</a></dd>
                    <dd><a href="article.php?id=14" target="_blank" title="如何享受全国联保">如何享受全国联保</a></dd>
           
        </dl>
         
                        <dl>
          <dt class="xs-3">配送与支付 </dt>
                      <dd><a href="article.php?id=15" target="_blank" title="货到付款区域">货到付款区域</a></dd>
                    <dd><a href="article.php?id=16" target="_blank" title="配送支付智能查询 ">配送支付智能查询</a></dd>
                    <dd><a href="article.php?id=17" target="_blank" title="支付方式说明">支付方式说明</a></dd>
           
        </dl>
         
                        <dl>
          <dt class="xs-4">会员中心</dt>
                      <dd><a href="article.php?id=18" target="_blank" title="资金管理">资金管理</a></dd>
                    <dd><a href="article.php?id=19" target="_blank" title="我的收藏">我的收藏</a></dd>
                    <dd><a href="article.php?id=20" target="_blank" title="我的订单">我的订单</a></dd>
           
        </dl>
         
                 
                 
         
        <div class="foot-weixin">
          <div class="weixin-txt">关注demo微信</div>
          <div class="weixin-pic">
            <img src="themes/default/images/weixin.jpg">
          </div>
        </div>
    </div>
     
    
   
  
  <div class="blank"></div>
  
<div class="footer_info"> &copy; 2005-2019 ECSHOP 版权所有，并保留所有权利。       <br />
      <a href="http://xyunqi.com/products/ecshop?from=nav" target="_blank" style=" font-family:Verdana; font-size:11px;">Powered&nbsp;by&nbsp;<strong><span style="color: #3366FF">ECShop</span>&nbsp;<span style="color: #FF9966">v4.0.0</span></strong></a>&nbsp;<a href="http://www.ecshop.com/license.php?product=ecshop_b2c&url=http%3A%2F%2Fwww.eshop.com%2F" target="_blank"
>&nbsp;&nbsp;Licensed</a><br />
            <div>ICP备案证书号:<a href="http://www.miibeian.gov.cn/" target="_blank"></a></div>
    </div>
  <div class="clear10"></div>
</div>
 

 

</body>
<script type="text/javascript">
var process_request = "正在处理您的请求...";
var username_empty = "- 用户名不能为空。";
var username_shorter = "- 用户名长度不能少于 3 个字符。";
var username_invalid = "- 用户名只能是由字母数字以及下划线组成。";
var password_empty = "- 登录密码不能为空。";
var password_shorter = "- 登录密码不能少于 6 个字符。";
var confirm_password_invalid = "- 两次输入密码不一致";
var email_empty = "- Email 为空";
var email_invalid = "- Email 不是合法的地址";
var agreement = "- 您没有接受协议";
var msn_invalid = "- msn地址不是一个有效的邮件地址";
var qq_invalid = "- QQ号码不是一个有效的号码";
var home_phone_invalid = "- 家庭电话不是一个有效号码";
var office_phone_invalid = "- 办公电话不是一个有效号码";
var mobile_phone_invalid = "- 手机号码不是一个有效号码";
var msg_un_blank = "* 用户名不能为空";
var msg_un_length = "* 用户名最长不得超过7个汉字";
var msg_un_format = "* 用户名含有非法字符";
var msg_un_registered = "* 用户名已经存在,请重新输入";
var msg_can_rg = "* 可以注册";
var msg_email_blank = "* 邮件地址不能为空";
var msg_email_registered = "* 邮箱已存在,请重新输入";
var msg_email_format = "* 邮件地址不合法";
var msg_blank = "不能为空";
var no_select_question = "- 您没有完成密码提示问题的操作";
var passwd_balnk = "- 密码中不能包含空格";
var username_exist = "用户名 %s 已经存在";
var compare_no_goods = "您没有选定任何需要比较的商品或者比较的商品数少于 2 个。";
var btn_buy = "购买";
var is_cancel = "取消";
var select_spe = "请选择商品属性";

function checkIpt(item){
  var val = item.value;
  var method = document.getElementById('payMethod');
  if(val == 'wxpay'){
    method.innerHTML = '微&nbsp;&nbsp;&nbsp;信';
  }else{
    method.innerHTML = '支付宝';
  }
  document.getElementById('yunqi_payment').click();
}
</script>
</html>
