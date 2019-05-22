<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="Generator" content="ECSHOP v4.0.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Keywords" content="" />
    <meta name="Description" content="" />
    <title>用户中心_ECSHOP演示站 - Powered by ECShop</title>
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="icon" href="animated_favicon.gif" type="image/gif" />
    <link href="shop_static/themes/default/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="shop_static/js/common.js"></script>
    <script type="text/javascript" src="shop_static/js/user.js"></script>
    <script type="text/javascript" src="shop_static/js/transport.js"></script>

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
                <div>当前位置: <a href=".">首页</a> <code>&gt;</code> 用户中心</div>
            </div>
        </div>
    </div>
    <div class="blank"></div>
    <div class="usBox clearfix">
        <div class="usBox_1 f_l">
            <div class="logtitle"></div>
            <form name="formLogin"  method="post" onSubmit="return userLogin()">
                 <?=snow\tpl::from_token()?>
                <table width="100%" border="0" align="left" cellpadding="3" cellspacing="5">
                    <tr>
                        <td width="15%" align="right">用户名</td>
                        <td width="85%"><input name="username" type="text" size="25" class="inputBg" placeholder="请输入用户名/手机号" /></td>
                    </tr>
                    <tr>
                        <td align="right">密码</td>
                        <td>
                            <input name="password" type="password" size="15" class="inputBg" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="checkbox" value="1" name="remember" id="remember" /><label for="remember">请保存我这次的登录信息。</label></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td align="left">
                            <input type="submit" name="submit" value="" class="us_Submit" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="f3">找回密码：（<a href="user.php?act=qpassword_name" class="f3">密码问题</a>&nbsp;<a href="user.php?act=get_password" class="f3">邮件</a>&nbsp;<a href="user.php?act=sms_get_password" class="f3">短信验证</a>）</td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="usTxt">
            <strong>如果您不是会员，请注册</strong> <br />
            <strong class="f4">友情提示：</strong><br />
            不注册为会员也可在本店购买商品<br />
            但注册之后您可以：<br />
            1. 保存您的个人资料<br />
            2. 收藏您关注的商品<br />
            3. 享受会员积分制度<br />
            4. 订阅本店商品信息 <br />
            <a href="?ctl=member&act=register"><img src="shop_static/themes/default/images/bnt_ur_reg.gif" /></a>
        </div>
    </div>
    <div class="blank"></div>
  
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
</script>

</html>