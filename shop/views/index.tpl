<!DOCTYPE html>
<html>

<head>
   <meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?=snow\config::$obj->app->get("title")?>
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="public/components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="public/components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="public/css/AdminLTE.min.css">
    <link rel="stylesheet" href="public/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="public/components/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script src="public/components/jquery/dist/jquery.min.js"></script>
    <style type="text/css">
    .nav_tab {
        height: 40px;
        border-right: 1px solid #ccc;
        border-radius: 0px;
    }

    .nav_tab_active {
        background: #EAEAEA
    }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?=snow\tpl::display("index.header.tpl")?>
        <?=snow\tpl::run_controller("index","menus")?>

        <div class="content-wrapper" style="background-color:#ffffff">
            <div class="tab" style="background: #FFFFFF;height: 40px;width: 100%;border-bottom: 1px solid #ccc">
                <div style="float: left;">
                    <label class="pull-left nav_tab btn" style="width: 40px"><i class="fa fa-backward"></i></label>
                </div>
                <div id="content_tab" style="overflow: hidden;height: 50px;float: left;">
                </div>
                <div class="pull-right">
                    <label class="pull-right nav_tab btn" style="width: 100px" data-toggle="dropdown">关闭操作<span class="caret"></span></label>
                    <label class="pull-right nav_tab btn" id="refresh" style="width: 40px"><i class="fa fa-refresh"></i>
                    </label>
                    <label class="pull-right nav_tab btn" id="next_iframe" style="border-left: 1px solid #ccc;width: 40px"><i class="fa fa-forward"></i>
                    </label>
                    <ul role="menu" class="dropdown-menu dropdown-menu-right" style="top:87px">
                        <li class="J_tabShowActive"><a>定位当前选项卡</a> </li>
                        <li class="divider"></li>
                        <li class="J_tabCloseAll"><a>关闭全部选项卡</a> </li>
                        <li class="J_tabCloseOther"><a>关闭其他选项卡</a> </li>
                    </ul>
                </div>
            </div>
            <div style="position:absolute;height: auto;" id="content-iframes">
            </div>
        </div>
    
        <?=snow\tpl::display("index.right.tpl")?>
        <div id="msg" class="hidden">
            <?=snow\tpl::get_json_assign()?>
        </div>
    </div>
    <script src="public/components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="public/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="public/js/demo.js"></script>
    <script src="public/js/template-web.js"></script>
    <script type="text/javascript" src="public/js/main.js"></script>
    <script type="text/javascript">
    
   function frame_load(obj)
   {
        content_width();
        return true;
   }
    function content_width()
    {
        var main_sidebar_width = $(".main-sidebar").width();
        var width = $("body").width();
        $("#content-iframes").width(parseInt(width)-parseInt(main_sidebar_width));
          $("#content-iframes iframe").attr("width","100%");
    }
    function click_tab(obj)
    {
         var id = $(".nav_tab_active").attr("id");
        if(id == obj.id)
        {
            return false;
        }
        if($("#iframe"+obj.id).length>0)
        {
            $("#content-iframes iframe").addClass("hide");
           
            $("#iframe"+obj.id).removeClass("hide");
        }
         $(".nav_tab").removeClass("nav_tab_active");
        $(".label"+obj.id).addClass("nav_tab_active");
    }
    window.onresize = function()
    {
         content_width();
    }
    $(document).ready(function() {
        rendering('msg', true);
        content_width();
        var height = $(".main-sidebar").height();
        $(".content-wrapper").height(height+500)
        $(".menu-li").click(function() {
            var href = $(this).attr("href");
            var name = $(this).text();
            var id = this.id;
            $(".treeview-menu li").removeClass("active");
            $(this).parent().addClass("active")

            if($("#iframe"+id).length>0)
            {
                $("#content-iframes iframe").addClass("hide");
                $("#iframe"+id).removeClass("hide");
                $(".nav_tab").removeClass("nav_tab_active");
                $(".label"+id).addClass("nav_tab_active");
                return false;
            }
            var _html = '<label id="'+id+'" class="nav_tab nav_tab_active label'+id+'" style="padding: 10px;">';
            _html += '<span id="'+id+'" onclick="click_tab(this)">' + name + '</span>';
            $(".nav_tab").removeClass("nav_tab_active");
            $("#content_tab").prepend(_html);
            var _html = '  <iframe onload="frame_load(this)" id="iframe'+id+'" frameborder=”no” border=”0″ marginwidth=”0″ marginheight=”0″ scrolling=”no” allowtransparency=”yes” width="100%"  height="'+height+'px" src="' + href + '"></iframe>';
            $("#content-iframes iframe").addClass("hide");
            $("#content-iframes").prepend(_html);
            window.setTimeout(function(){
                var iframe_height = document.getElementById('iframe'+id).contentWindow.document.body.scrollHeight;
                var body_height = $(window).height();
                if(body_height<iframe_height)
                {
                    $('#iframe'+id).attr("height",iframe_height+"px");
                }else{
                     $('#iframe'+id).attr("height",body_height+"px");
                }
                },1000);
            return false;
        });
        $("#refresh").click(function(){
            var id = $(".nav_tab_active").attr("id");
            if(!id)
            {
                return false;
            }
            document.getElementById('iframe'+id).contentWindow.location.reload(true);
        });
         var sidebar_click_num = 0;
        $("#sidebar-toggle").click(function(){
            var main_sidebar_width = $(".main-sidebar").width();
           if(sidebar_click_num%2 == 0)
           {
             var width = parseInt($(".tab").width())+parseInt(main_sidebar_width)-50;
             $("#content-iframes iframe").attr("width",width+"px");
           }else{
             $("#content-iframes iframe").attr("width","100%");
           }
           sidebar_click_num++;
        });
        var parent_id = $(".active-menu-li").attr("parent_id");
        $("#menus-li"+parent_id).addClass("menu-open");
         $("#menus-li"+parent_id).find(".treeview-menu").css("display","block");
         $(".active-li-a").click();
    });
    </script>
</body>
</html>





