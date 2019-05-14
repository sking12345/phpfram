<!DOCTYPE html>
<html>

<head>
    <meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>用户列表</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="public/components/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="public/components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="public/components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="public/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="public/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="public/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="public/css/main.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="content">
        <ul class="breadcrumb" style="margin-bottom:5px;background:#FFF;padding-left:0px">
            <li><i class="fa fa-fw fa-calendar-check-o"></i>商品管理</li>
            <li><a href="?ctl=<?=snow\req::item('ctl')?>&act=index"><i class="fa fa-fw fa-search"></i>供应商</a></li>
            <li class="active"><i class="fa fa-fw fa-search"></i>查看供应商</li>
        </ul>
       
            <div class="box content" style="min-height:100px">
            <script type="text/html" id="infos">
            <div class="box-body">
                <form class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label">名称:</label>
                    <div class="col-sm-4">
                         <p class="form-control-static">{{infos.name}}</p>
                    </div>
                    <label class="col-sm-2 control-label">办公电话:</label>
                    <div class="col-sm-4">
                         <p class="form-control-static">{{infos.tel}}</p>
                    </div>
                </div>
                    <div class="form-group">
                    <label class="col-sm-2 control-label">联系人:</label>
                    <div class="col-sm-4">
                         <p class="form-control-static">{{infos.contact}}</p>
                    </div>
                    <label class="col-sm-2 control-label">手机号:</label>
                    <div class="col-sm-4">
                         <p class="form-control-static">{{infos.phone}}</p>
                    </div>
                </div>
                <div class="form-group">
                   <label class="col-sm-2 control-label">状态:</label>
                    <div class="col-sm-4">
                         <p class="form-control-static">
                        {{if infos.status==1}}
                                正常 &nbsp; &nbsp; &nbsp;
                                <a class="btn btn-warning btn-xs" href="?ctl=<?=snow\req::item('ctl')?>&act=stop_use&id=<?=snow\req::item('id')?>">暂停</a>
                            {{else}}
                             暂停 &nbsp; &nbsp; &nbsp;
                             <a class="btn btn-success btn-xs"  href="?ctl=<?=snow\req::item('ctl')?>&act=restore_use&id=<?=snow\req::item('id')?>">恢复正常</a>
                            {{/if}}
                        </p>
                    </div>
                </div>
                   <div class="form-group">
                   <label class="col-sm-2 control-label">地址:</label>
                    <div class="col-sm-4">
                         <p class="form-control-static">
                            {{infos.addr}}
                        </p>
                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">描述:</label>
                     <div class="col-sm-10">
                         <p class="form-control-static">{{infos.remarks}}</p>
                    </div>
                 </div>
                </form>
            </div>
            <div class="box-footer">
                <label class="col-sm-1 control-label"></label>
                <a href="?ctl=<?=snow\req::item('ctl')?>&act=edit&id={{infos.id}}&back=infos" class="btn btn-sm btn-primary">
                    <i class="fa fa-fw fa-edit"></i>编辑
                </a>
                <a href="?ctl=<?=snow\req::item('ctl')?>&act=status_list&id={{infos.id}}" class="btn btn-sm btn-primary">
                    <i class="fa fa-fw fa-reorder"></i>状态列表
                </a>
                 <a href="?ctl=<?=snow\req::item('ctl')?>&act=del&id={{infos.id}}" class="btn  btn-sm  btn-danger">
                    <i class="fa fa-fw fa-remove"></i>删除
                </a>
            </div>
        </script>
        </div>
    </div>


    </div>
   
    <div id="msg" class="hidden">
        <?=snow\tpl::get_json_assign()?>
    </div>
    <script src="public/components/jquery/dist/jquery.min.js"></script>
    <script src="public/js/verifyform.js"></script>
    <script src="public/components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="public/dist/js/adminlte.min.js"></script>
    <script src="public/js/template-web.js"></script>
    <script src="public/js/main.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        rendering('msg', true);
    });
    </script>
</body>

</html>