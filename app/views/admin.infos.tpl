<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
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
    <div class="content" >
    <div>
      <ol class="breadcrumb" style="margin-bottom:5px;background:#FFF;padding-left:0px">
        <li><a href="?ctl=admin&act=index"><i class="fa fa-fw fa-user"></i>用户管理</a></li>
        <li class="active"><i class="fa fa-fw fa-search"></i>查看用户信息</li>
      </ol>
    </div>
      <div class="box content" style="min-height:100px">
        <form class="form-horizontal">
          <script type="text/html" id="infos">
            
          <div class="form-group">
            <label  class="col-sm-2 control-label">头像:</label>
            <div class="col-sm-4">
               <p class="form-control-static">
               <img src="{{infos.img}}" class="img-circle" style="width: 50px"> 
            </p>
            </div>
               <label  class="col-sm-2 control-label">用户名:</label>
            <div class="col-sm-4">
              <p class="form-control-static">{{infos.username}}</p>
            </div>
          </div>
           <div class="form-group">
        
            <label  class="col-sm-2 control-label">昵称:</label>
            <div class="col-sm-4">
              <p class="form-control-static">{{infos.nickname}}</p>
            </div>
            <label  class="col-sm-2 control-label">创建时间:</label>
            <div class="col-sm-4">
              <p class="form-control-static">{{infos.create_time}}</p>
            </div>
          </div>
           </script>
        </form>
          <div class="box-footer">
          <label class="col-sm-1 control-label"></label>
          <a href="?ctl=admin&act=del&id=<?=snow\req::item('id')?>>" class="btn btn-danger  btn-sm"><i class="fa fa-fw fa-remove"></i>删除</a>
           <a href="?ctl=admin&act=edit&id=<?=snow\req::item('id')?>" class="btn btn-primary  btn-sm"><i class="fa fa-fw fa-edit"></i>编辑</a>
            <a href="?ctl=admin&act=set_purview&id=<?=snow\req::item('id')?>" class="btn btn-info  btn-sm"><i class="fa fa-gears"></i>设置独立权限</a>
        </div>
      </div>
    
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
        });
        </script>
</body>

</html>















