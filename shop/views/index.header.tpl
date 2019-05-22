<div class="top-bar">
  <div class="fd_top fd_top1">
    <div class="bar-left">
          <div class="top_menu1"> 

          <font id="ECS_MEMBERZONE">
          <div id="append_parent">
          </div>
            <?=snow\user::get("name")?>欢迎光临本店
            <?php if (snow\user::is_login() == false){?>
          <a href="?ctl=member&act=login">请登录 <strong>
          </strong></a>
           &nbsp;|&nbsp;&nbsp;
          <a href="user.php?act=register">免费注册</a> 
          </font> 
          <?php }?>
          </div>
    </div>
    <div class="bar-cart">
      <div class="fl cart-yh">
        <a href="user.php" class="">用户中心</a>
      </div>
             <div class="cart" id="ECS_CARTINFO"> <a href="?ctl=merchandise&act=buy" title="查看购物车">购物车(0)</a> </div>
    </div>
  </div>
</div>