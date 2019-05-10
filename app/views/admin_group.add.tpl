<!DOCTYPE html>
<html>

<head>
  <meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″> 
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>用户列表</title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="public/components/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="public/components/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="public/components/Ionicons/css/ionicons.min.css">
<link rel="stylesheet" href="public/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="public/dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="public/dist/css/skins/_all-skins.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="content">
    <ol class="breadcrumb" style="margin-bottom:5px;background:#FFF;padding-left:0px">
        <li><a href="?ctl=admin_group&act=index"><i class="fa fa-fw fa-user"></i>用户组管理</a></li>
        <li class="active"><i class="fa fa-plus-circle"></i>添加用户组</li>
    </ol>
    <form class="form-horizontal" method="POST">
        <?=snow\tpl::from_token()?>
        <div class="box content" style="min-height:100px">
            <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">用户组名:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" value="" name="name" placeholder="用户名">
                    </div>
                </div>
                <script type="text/html" id="purview">
                {{each purview as item i}}
                <div class="form-group">
                 <label class="col-sm-2 control-label"><input type="checkbox" class="parent" id="parent{{item.id}}" parent-id="{{item.id}}">&nbsp;{{item.name}}:</label>
                 <div class="col-sm-9" style="margin-top: 7px">
                     {{each item.children as item1 i1}}
                     <label style="font-weight: 400"><input type="checkbox" parent-id="{{item.id}}" class="parent{{item.id}} menus" name="purviews[{{item1.ctl}}_{{item1.act}}]">&nbsp;{{item1.name}}</label>&nbsp;&nbsp;&nbsp;&nbsp;
                     {{/each}}
                 </div>
               </div>
               {{/each}}
                </script>
            </div>
            <div class="box-footer">
                <label class="col-sm-2 control-label"></label>
                <button type="submit" class="btn btn-info">提交</button>
            </div>
        </div>
    </form>
</div>
<div id="msg" class="hidden">
    <?=snow\tpl::get_json_assign()?>
</div>
<script src="public/components/jquery/dist/jquery.min.js"></script>
<script src="public/components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="public/dist/js/adminlte.min.js"></script>
<script src="public/js/template-web.js"></script>
<script type="text/javascript" src="public/js/main.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    rendering('msg', true);
    $(".parent").click(function(){
       var check = $(this).is(":checked");
       var id = $(this).attr("parent-id");
       if(check == true)
       {
        $(".parent"+id+":not(:checked)").prop("checked",true);
       }else{
        $(".parent"+id+":checked").prop("checked",false);
       }
    })
    $(".menus").click(function(){
        var id = $(this).attr("parent-id");
        var length = $(".parent"+id+":not(:checked)").length;
         if($(".parent"+id+":not(:checked)").length>0)
         {
             $("#parent"+id).prop("checked",false);
         }else{
             $("#parent"+id).prop("checked",true);
         }
    })
});
</script>
</body>

</html>





