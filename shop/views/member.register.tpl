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
    <div class="usBox">
        <div class="usBox_2 clearfix">
            <div class="regtitle"></div>
            <form method="post" name="formUser" onsubmit="return register();">
              <?=snow\tpl::from_token()?>
                <table width="100%" border="0" align="left" cellpadding="5" cellspacing="3">
                    <tr>
                        <td width="13%" align="right">用户名</td>
                        <td width="87%">
                            <input name="username" type="text" size="25" id="username" onblur="is_registered(this.value);" class="inputBg" />
                            <span id="username_notice" style="color:#FF0000"> *</span>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">email</td>
                        <td>
                            <input name="email" type="text" size="25" id="email" onblur="checkEmail(this.value);" class="inputBg" />
                            <span id="email_notice" style="color:#FF0000"> *</span>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">密码</td>
                        <td>
                            <input name="password" type="password" id="password1" onblur="check_password(this.value);" onkeyup="checkIntensity(this.value)" class="inputBg" style="width:179px;" />
                            <span style="color:#FF0000" id="password_notice"> *</span>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">密码强度</td>
                        <td>
                            <table width="145" border="0" cellspacing="0" cellpadding="1">
                                <tr align="center">
                                    <td width="33%" id="pwd_lower">弱</td>
                                    <td width="33%" id="pwd_middle">中</td>
                                    <td width="33%" id="pwd_high">强</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">确认密码</td>
                        <td>
                            <input name="confirm_password" type="password" id="conform_password" onblur="check_conform_password(this.value);" class="inputBg" style="width:179px;" />
                            <span style="color:#FF0000" id="conform_password_notice"> *</span>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">QQ <td>
                            <input name="extend_field2" type="text" size="25" class="inputBg" /> </td>
                    </tr>
                    <tr>
                        <td align="right">办公电话 <td>
                            <input name="extend_field3" type="text" size="25" class="inputBg" /> </td>
                    </tr>
                    <tr>
                        <td align="right">家庭电话 <td>
                            <input name="extend_field4" type="text" size="25" class="inputBg" /> </td>
                    </tr>
                    <tr>
                        <td align="right" id="extend_field5i">手机 <td>
                            <input name="extend_field5" type="text" size="25" class="inputBg" /><span style="color:#FF0000"> *</span> </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><label>
                                <input name="agreement" type="checkbox" value="1" checked="checked" />
                                我已看过并接受《<a href="article.php?cat_id=-1" style="color:blue" target="_blank">用户协议</a>》</label></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td align="left">
                           
                            <input type="hidden" name="back_act" value="" />
                            <input name="Submit" type="submit" value="" class="us_Submit_reg">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td class="actionSub">
                            <a href="?ctl=member&act=login">我已有账号，我要登录</a><br />
                            <a href="?ctl=member&act=get_password">您忘记密码了吗？</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <div class="blank"></div>

</body>


</html>