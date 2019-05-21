<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="{$keywords}" />
<meta name="Description" content="{$description}" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>{$page_title}</title>
<!-- TemplateEndEditable --><!-- TemplateBeginEditable name="head" --><!-- TemplateEndEditable -->
<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link href="{$ecs_css_path}" rel="stylesheet" type="text/css" />
{* 包含脚本文件 *}
{insert_scripts files='common.js'}
<script type="text/javascript">
function $id(element) {
  return document.getElementById(element);
}
//切屏--是按钮，_v是内容平台，_h是内容库
function reg(str){
  var bt=$id(str+"_b").getElementsByTagName("h2");
  for(var i=0;i<bt.length;i++){
    bt[i].subj=str;
    bt[i].pai=i;
    bt[i].style.cursor="pointer";
    bt[i].onclick=function(){
      $id(this.subj+"_v").innerHTML=$id(this.subj+"_h").getElementsByTagName("blockquote")[this.pai].innerHTML;
      for(var j=0;j<$id(this.subj+"_b").getElementsByTagName("h2").length;j++){
        var _bt=$id(this.subj+"_b").getElementsByTagName("h2")[j];
        var ison=j==this.pai;
        _bt.className=(ison?"":"h2bg");
      }
    }
  }
  $id(str+"_h").className="none";
  $id(str+"_v").innerHTML=$id(str+"_h").getElementsByTagName("blockquote")[0].innerHTML;
}

</script>
</head>
<body>
<!-- #BeginLibraryItem "/library/page_header.lbi" --><!-- #EndLibraryItem -->
<div class="goods-home">
  

<!--当前位置 start-->
<div class="block box">
  <div id="ur_here"> <!-- #BeginLibraryItem "/library/ur_here.lbi" --><!-- #EndLibraryItem --> </div>
</div>
<!--当前位置 end-->
<div class="blank"></div>
<div class="block clearfix">
  <!--right start-->
  <div class="AreaR">
    <!--商品详情start-->
    <div id="goodsInfo" class="clearfix">
      <!--商品图片和相册 start-->
      <div class="imgInfo">
        <!-- {if $pictures}-->
        <a href="javascript:;" onclick="window.open('gallery.php?id={$goods.goods_id}'); return false;"> <img src="{$goods.goods_img}" alt="{$goods.goods_name|escape:html}"/> </a>
        <!-- {else} -->
        <img src="{$goods.goods_img}" alt="{$goods.goods_name|escape:html}"/>
        <!-- {/if}-->
        <div class="blank5"></div>
        <!--相册 START-->
        <!-- #BeginLibraryItem "/library/goods_gallery.lbi" --><!-- #EndLibraryItem -->
        <!--相册 END-->
        <div class="blank5"></div>
        <!-- TemplateBeginEditable name="商品相册下广告（宽230px）" --> <!-- TemplateEndEditable --> </div>
      <!--商品图片和相册 end-->
      <div class="textInfo">
        <form action="javascript:addToCart({$goods.goods_id})" method="post" name="ECS_FORMBUY" id="ECS_FORMBUY" >
          <div class="goods_style_name"> {$goods.goods_style_name} </div>
          <ul>
            <!-- {if $promotion} -->
            <li class="padd">
              <!-- {foreach from=$promotion item=item key=key} 优惠活动-->
              {$lang.activity}
              <!-- {if $item.type eq "snatch"} -->
              <a href="snatch.php" title="{$lang.snatch}" style="font-weight:100; color:#006bcd; text-decoration:none;">[{$lang.snatch}]</a>
              <!-- {elseif $item.type eq "group_buy"} -->
              <a href="group_buy.php" title="{$lang.group_buy}" style="font-weight:100; color:#006bcd; text-decoration:none;">[{$lang.group_buy}]</a>
              <!-- {elseif $item.type eq "auction"} -->
              <a href="auction.php" title="{$lang.auction}" style="font-weight:100; color:#006bcd; text-decoration:none;">[{$lang.auction}]</a>
              <!-- {elseif $item.type eq "favourable"} -->
              <a href="activity.php" title="{$lang.favourable}" style="font-weight:100; color:#006bcd; text-decoration:none;">[{$lang.favourable}]</a>
              <!-- {/if} -->
              <a href="{$item.url}" title="{$lang.$item.type} {$item.act_name}{$item.time}" style="font-weight:100; color:#006bcd;">{$item.act_name}</a><br />
              <!-- {/foreach} -->
            </li>
            <!-- {/if} -->
            <li class="clearfix">
              <dd>
                <!-- {if $cfg.show_goodssn} 显示商品货号-->
                <strong>{$lang.goods_sn}</strong>{$goods.goods_sn}
                <!-- {/if} -->
              </dd>
              <dd class="ddR">
                <!-- {if $goods.goods_number neq "" and $cfg.show_goodsnumber} 商品库存-->
                <!-- {if $goods.goods_number eq 0} -->
                <strong>{$lang.goods_number}</strong> <font color='red'>{$lang.stock_up}</font>
                <!-- {else} -->
                <strong>{$lang.goods_number}</strong> {$goods.goods_number} {$goods.measure_unit}
                <!-- {/if} -->
                <!-- {/if} -->
              </dd>
            </li>
            <li class="clearfix">
              <dd>
                <!-- {if $goods.goods_brand neq "" and $cfg.show_brand} 显示商品品牌-->
                <strong>{$lang.goods_brand}</strong><a href="{$goods.goods_brand_url}" >{$goods.goods_brand}</a>
                <!--{/if}-->
              </dd>
              <dd class="ddR">
                <!-- {if $cfg.show_goodsweight} 商品重量-->
                <strong>{$lang.goods_weight}</strong>{$goods.goods_weight}
                <!-- {/if} -->
              </dd>
            </li>
            <li class="clearfix">
              <dd>
                <!-- {if $cfg.show_addtime} 上架时间-->
                <strong>{$lang.add_time}</strong>{$goods.add_time}
                <!-- {/if} -->
              </dd>
              <dd class="ddR">
                <!--点击数-->
                <strong>{$lang.goods_click_count}：</strong>{$goods.click_count} </dd>
                <dd class="ddR">
       <!--累计销量-->
       <strong>{$lang.cum_sales}</strong>{$goods.cum_sales}
       </dd>
            </li>
            <li class="clearfix">
              <dd>
                <!-- {if $cfg.show_marketprice} 市场价格-->
                <strong>{$lang.market_price}</strong><font class="market">{$goods.market_price}</font> </dd>
              <!-- {/if} -->
              <!--本店售价-->
              <dd><strong>{$lang.shop_price}</strong><font class="shop" id="ECS_SHOPPRICE">{$goods.shop_price_formated}</font> </dd>
              <!-- {foreach from=$rank_prices item=rank_price key=key} 会员等级对应的价格-->
              <dd><strong>{$rank_price.rank_name}：</strong><font class="shop" id="ECS_RANKPRICE_{$key}">{$rank_price.price}</font> </dd>
              <!--{/foreach}-->
            </li>
            <!--{if $volume_price_list } -->
            <li class="padd"> <font class="f1">{$lang.volume_price}</font><br />
              <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#aad6ff">
                <tr>
                  <td align="center" bgcolor="#FFFFFF"><strong>{$lang.number_to}</strong></td>
                  <td align="center" bgcolor="#FFFFFF"><strong>{$lang.preferences_price}</strong></td>
                </tr>
                <!-- {foreach from=$volume_price_list item=price_list key=price_key} -->
                <tr>
                  <td align="center" bgcolor="#FFFFFF" class="shop">{$price_list.number}</td>
                  <td align="center" bgcolor="#FFFFFF" class="shop">{$price_list.format_price}</td>
                </tr>
                <!-- {/foreach} -->
              </table>
            </li>
            <!--{/if}-->
            <!--{if $goods.is_promote and $goods.gmt_end_time } 促销-->
            {insert_scripts files='lefttime.js'}
            <li class="padd loop" style="margin-bottom:5px; border-bottom:1px dashed #ccc;"> <strong>{$lang.promote_price}</strong><font class="shop">{$goods.promote_price}</font><br />
              <strong>{$lang.residual_time}</strong> <font class="f4" id="leftTime">{$lang.please_waiting}</font><br />
            </li>
            <!--{/if}-->
            <li class="clearfix">
              <dd> <strong>{$lang.amount}：</strong><font id="ECS_GOODS_AMOUNT" class="shop"></font> </dd>
              <dd class="ddR">
                <!-- {if $goods.give_integral > 0} 购买此商品赠送积分-->
                <strong>{$lang.goods_give_integral}</strong><font class="f4">{$goods.give_integral} {$points_name}</font>
                <!-- {/if} -->
              </dd>
            </li>
            <!-- {if $goods.bonus_money} 红包-->
            <li class="padd loop" style="margin-bottom:5px; border-bottom:1px dashed #ccc;"> <strong>{$lang.goods_bonus}</strong><font class="shop">{$goods.bonus_money}</font><br />
            </li>
            <!-- {/if} -->
            <li class="clearfix">
              <dd> <strong>{$lang.number}：</strong>
                <input name="number" type="text" id="number" value="1" size="4" onblur="changePrice()" style="border:1px solid #ccc; "/>
              </dd>
              <dd class="ddR">
                <!-- {if $cfg.use_integral} 购买此商品可使用积分-->
                <strong>{$lang.goods_integral}</strong><font class="f4">{$goods.integral} {$points_name}</font>
                <!-- {/if} -->
              </dd>
            </li>
            <!-- {if $goods.is_shipping} 为免运费商品则显示-->
            <li style="height:30px;padding-top:4px;"> {$lang.goods_free_shipping}<br />
            </li>
            <!-- {/if} -->
            <!-- {* 开始循环所有可选属性 *} -->
            <!-- {foreach from=$specification item=spec key=spec_key} -->
            <li class="padd loop"> <strong>{$spec.name}:</strong><br />
              <!-- {* 判断属性是复选还是单选 *} -->
              <!-- {if $spec.attr_type eq 1} -->
              <!-- {if $cfg.goodsattr_style eq 1} -->
              <!-- {foreach from=$spec.values item=value key=key} -->
              <label for="spec_value_{$value.id}">
              <input type="radio" name="spec_{$spec_key}" value="{$value.id}" id="spec_value_{$value.id}" {if $key eq 0}checked{/if} onclick="changePrice()" />
              {$value.label} [{if $value.price gt 0}{$lang.plus}{elseif $value.price lt 0}{$lang.minus}{/if} {$value.format_price|abs}] </label>
              <br />
              <!-- {/foreach} -->
              <input type="hidden" name="spec_list" value="{$key}" />
              <!-- {else} -->
              <select name="spec_{$spec_key}" onchange="changePrice()">
                <!-- {foreach from=$spec.values item=value key=key} -->
                <option label="{$value.label}" value="{$value.id}">{$value.label} {if $value.price gt 0}{$lang.plus}{elseif $value.price lt 0}{$lang.minus}{/if}{if $value.price neq 0}{$value.format_price}{/if}</option>
                <!-- {/foreach} -->
              </select>
              <input type="hidden" name="spec_list" value="{$key}" />
              <!-- {/if} -->
              <!-- {else} -->
              <!-- {foreach from=$spec.values item=value key=key} -->
              <label for="spec_value_{$value.id}">
              <input type="checkbox" name="spec_{$spec_key}" value="{$value.id}" id="spec_value_{$value.id}" onclick="changePrice()" />
              {$value.label} [{if $value.price gt 0}{$lang.plus}{elseif $value.price lt 0}{$lang.minus}{/if} {$value.format_price|abs}] </label>
              <br />
              <!-- {/foreach} -->
              <input type="hidden" name="spec_list" value="{$key}" />
              <!-- {/if} -->
            </li>
            <!-- {/foreach} -->
            <!-- {* 结束循环可选属性 *} -->
            <li class="padd">
              <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="td1"><a href="javascript:addToCart({$goods.goods_id})"><img src="images/buybtn1.png" /></a></td>
                  <td class="td2"><a href="javascript:collect({$goods.goods_id})"><img src="images/bnt_colles.gif" /></a></td>
                  <!-- {if $affiliate.on} -->
                  <td class="td3"><a href="user.php?act=affiliate&goodsid={$goods.goods_id}"><img src='images/bnt_recommend.gif'></a> </td>
                  <!-- {/if} -->
                </tr>
              </table>
            </li>
            
          </ul>
        </form>
      </div>
    </div>
    <div class="blank"></div>
    <!--商品详情end-->
    <!--商品描述，商品属性 START-->
    <div class="box clearfix">
      <div class="box_1 goods-boxg">
        <div class="box_top">
          <div id="com_b" class="history clearfix">
            <h2>{$lang.goods_brief}</h2>
            <h2 class="h2bg">{$lang.goods_attr}</h2>
            <!-- {if $package_goods_list} -->
            <h2 class="h2bg" style="color:red;">{$lang.remark_package}</h2>
            <!-- {/if} -->
          </div>
        </div>
        <div id="com_v" class="boxCenterList RelaArticle"></div>
        <div id="com_h">
          <blockquote> {$goods.goods_desc} </blockquote>
          <blockquote>
            <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#dddddd">
              <!-- {foreach from=$properties item=property_group key=key} -->
              <tr>
                <th colspan="2" bgcolor="#FFFFFF">{$key|escape}</th>
              </tr>
              <!-- {foreach from=$property_group item=property} -->
              <tr>
                <td bgcolor="#FFFFFF" align="left" width="30%" class="f1">[{$property.name|escape:html}]</td>
                <td bgcolor="#FFFFFF" align="left" width="70%">{$property.value}</td>
              </tr>
              <!-- {/foreach}-->
              <!-- {/foreach}-->
            </table>
          </blockquote>
          <!-- {if $package_goods_list} -->
          <blockquote>
            <!-- {foreach from=$package_goods_list item=package_goods} -->
            <strong>{$package_goods.act_name}</strong><br />
            <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#dddddd">
              <tr>
                <td bgcolor="#FFFFFF"><!-- {foreach from=$package_goods.goods_list item=goods_list} -->
                  <a href="goods.php?id={$goods_list.goods_id}" target="_blank"><font class="f1">{$goods_list.goods_name}{$goods_list.goods_attr_str}</font></a> &nbsp;&nbsp;X {$goods_list.goods_number}<br />
                  <!-- {/foreach} -->
                </td>
                <td bgcolor="#FFFFFF"><strong>{$lang.old_price}</strong><font class="market">{$package_goods.subtotal}</font><br />
                  <strong>{$lang.package_price}</strong><font class="shop">{$package_goods.package_price}</font><br />
                  <strong>{$lang.then_old_price}</strong><font class="shop">{$package_goods.saving}</font><br />
                </td>
                <td bgcolor="#FFFFFF"><a href="javascript:addPackageToCart({$package_goods.act_id})" style="background:transparent"><img src="images/bnt_buy_1.gif" alt="{$lang.add_to_cart}" /></a> </td>
              </tr>
            </table>
            <!-- {/foreach} -->
          </blockquote>
          <!-- {/if} -->
        </div>
      </div>
    </div>
    <script type="text/javascript">
    <!--
    reg("com");
    //-->
    </script>
    <div class="blank"></div>
    <!--商品描述，商品属性 END-->
    <!-- TemplateBeginEditable name="右边可编辑区域" --> <!-- #BeginLibraryItem "/library/goods_tags.lbi" -->
    <div class="box">
      <div class="box_1">
        <h3><span class="text">{$lang.goods_tag}</span></h3>
        <div class="boxCenterList clearfix ie6">
          <form name="tagForm" action="javascript:;" onSubmit="return submitTag(this)" id="tagForm">
            <p id="ECS_TAGS" style="margin-bottom:5px;">
              <!-- 标记{foreach from=$tags item=tag}-->
              <a href="search.php?keywords={$tag.tag_words|escape:url}" style="color:#006ace; text-decoration:none; margin-right:5px;">{$tag.tag_words|escape:html}[{$tag.tag_count}]</a>
              <!-- 结束标记{/foreach} -->
            </p>
            <p>
              <input type="text" name="tag" id="tag" class="inputBg" size="35" />
              <input type="submit" value="添 加" class="bnt_blue" style="border:none;" />
              <input type="hidden" name="goods_id" value="{$goods.goods_id}"  />
            </p>
            <script type="text/javascript">
                //<![CDATA[
                {literal}
                /**
                 * 用户添加标记的处理函数
                 */
                function submitTag(frm)
                {
                  try
                  {
                    var tag = frm.elements['tag'].value;
                    var idx = frm.elements['goods_id'].value;

                    if (tag.length > 0 && parseInt(idx) > 0)
                    {
                      Ajax.call('user.php?act=add_tag', "id=" + idx + "&tag=" + tag, submitTagResponse, "POST", "JSON");
                    }
                  }
                  catch (e) { alert(e); }

                  return false;
                }

                function submitTagResponse(result)
                {
                  var div = document.getElementById('ECS_TAGS');

                  if (result.error > 0)
                  {
                    alert(result.message);
                  }
                  else
                  {
                    try
                    {
                      div.innerHTML = '';
                      var tags = result.content;

                      for (i = 0; i < tags.length; i++)
                      {
                        div.innerHTML += '<a href="search.php?keywords='+tags[i].word+'" style="color:#006ace; text-decoration:none; margin-right:5px;">' +tags[i].word + '[' + tags[i].count + ']<\/a>&nbsp;&nbsp; ';
                      }
                    }
                    catch (e) { alert(e); }
                  }
                }
                {/literal}
                //]]>
                </script>
          </form>
        </div>
      </div>
    </div>
    <div class="blank5"></div>
    <!-- #EndLibraryItem --> <!-- #BeginLibraryItem "/library/bought_goods.lbi" -->
    <!-- {if $bought_goods} -->
    <div class="box">
      <div class="box_1">
        <h3><span class="text">{$lang.shopping_and_other}</span></h3>
        <div class="boxCenterList clearfix ie6">
          <!--{foreach from=$bought_goods item=bought_goods_data}-->
          <div class="goodsItem"> <a href="{$bought_goods_data.url}"><img src="{$bought_goods_data.goods_thumb}" alt="{$bought_goods_data.goods_name}"  class="goodsimg" /></a><br />
            <p><a href="{$bought_goods_data.url}" title="{$bought_goods_data.goods_name}">{$bought_goods_data.short_name}</a></p>
            <!-- {if $bought_goods_data.promote_price neq 0} -->
            <font class="shop_s">{$bought_goods_data.formated_promote_price}</font>
            <!-- {else} -->
            <font class="shop_s">{$bought_goods_data.shop_price}</font>
            <!-- {/if} -->
          </div>
          <!-- {/foreach} -->
        </div>
      </div>
    </div>
    <div class="blank5"></div>
    <!-- {/if} -->
    <!-- #EndLibraryItem --> <!-- #BeginLibraryItem "/library/bought_note_guide.lbi" --> {insert_scripts files='transport.js,utils.js'}
    <div id="ECS_BOUGHT">{* ECSHOP 提醒您：动态载入bought_notes.lbi，显示当前商品的购买记录 *}{insert name='bought_notes' id=$id}</div>
    <!-- #EndLibraryItem --> <!-- #BeginLibraryItem "/library/comments.lbi" --> {insert_scripts files='transport.js,utils.js'}
    <div id="ECS_COMMENT"> {* ECSHOP 提醒您：动态载入comments_list.lbi，显示评论列表和评论表单 *}{insert name='comments' type=$type id=$id}</div>
    <!-- #EndLibraryItem --> <!-- TemplateEndEditable --> </div>
  <!--right end-->
</div>
<div class="blank5"></div>

<div class="blank"></div>
</div>
<!-- #BeginLibraryItem "/library/page_footer.lbi" --><!-- #EndLibraryItem -->
</body>
<script type="text/javascript">
var goods_id = {$goods_id};
var goodsattr_style = {$cfg.goodsattr_style|default:1};
var gmt_end_time = {$promote_end_time|default:0};
{foreach from=$lang.goods_js item=item key=key}
var {$key} = "{$item}";
{/foreach}
var goodsId = {$goods_id};
var now_time = {$now_time};

<!-- {literal} -->
onload = function(){
  changePrice();
  fixpng();
  try { onload_leftTime(); }
  catch (e) {}
}

/**
 * 点选可选属性或改变数量时修改商品价格的函数
 */
function changePrice()
{
  var attr = getSelectedAttributes(document.forms['ECS_FORMBUY']);
  var qty = document.forms['ECS_FORMBUY'].elements['number'].value;

  Ajax.call('goods.php', 'act=price&id=' + goodsId + '&attr=' + attr + '&number=' + qty, changePriceResponse, 'GET', 'JSON');
}

/**
 * 接收返回的信息
 */
function changePriceResponse(res)
{
  if (res.err_msg.length > 0)
  {
    alert(res.err_msg);
  }
  else
  {
    document.forms['ECS_FORMBUY'].elements['number'].value = res.qty;

    if (document.getElementById('ECS_GOODS_AMOUNT'))
      document.getElementById('ECS_GOODS_AMOUNT').innerHTML = res.result;
  }
}
<!-- {/literal} -->
</script>
</html>
