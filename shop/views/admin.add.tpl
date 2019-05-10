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
        <li><a href="?ctl=admin&act=index"><i class="fa fa-fw fa-user"></i>用户管理</a></li>
        <li class="active"><i class="fa fa-plus-circle"></i>添加用户</li>
    </ol>
    <form class="form-horizontal" method="POST" enctype="multipart/form-data" >
        <?=snow\tpl::from_token()?>
        <div class="box content" style="min-height:100px">
            <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">头像:</label>
                    <div class="col-sm-4">
                       
                        <p class="form-control-static">
                            <img src="" id="show_img" class="hide" height="50" width="50" align="middle" style="border-radius:50%">
                            <input type="file" name="photo" accept="image/*" multiple="false">
                        </p>
                    </div>
                    <label class="col-sm-2 control-label">用户名:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" value="" name="username" placeholder="用户名">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">昵称:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" value="" name="nickname" placeholder="昵称">
                    </div>
                    <label class="col-sm-2 control-label">分组</label>
                    <div class="col-sm-4">
                        <script type="text/html" id="infos">
                            <select class="form-control select2 select2-hidden-accessible" name="groups" style="width: 95%;">
                                <option value="">请选择用户组</option>
                                {{each groups_info as item i}}
                                  <option value="{{item.id}}">{{item.name}}</option>
                                {{/each}}
                            </select>
                         </script>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">密码:</label>
                    <div class="col-sm-4">
                        <p class="form-control-static">
                            <input type="password" class="form-control" value="" name="password" placeholder="密码">
                        </p>
                    </div>
                    <label class="col-sm-2 control-label">确认密码:</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" value="" name="password1" placeholder="确认密码">
                    </div>
                </div>
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
    $("input[name=photo]").change(function(){
        var files = this.files[0];
        console.log(files);
        var reader = new FileReader();
         reader.readAsDataURL(files);
         reader.onload=function(e){
            $('#show_img').get(0).src = e.target.result;
            $('#show_img').removeClass("hide");
         }
       
    })
});
</script>
</body>

</html>