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
         <li ><a href="?ctl=<?=snow\req::item('ctl')?>&act=index"><i class="fa fa-fw fa-reorder"></i>品牌列表</a></li>
        <li class="active"><i class="fa fa-fw fa-search"></i>查看品牌</li>
      </ul>
       
            <div class="box content" style="min-height:100px">
            <script type="text/html" id="infos">
            <div class="box-body">
                <form class="form-horizontal">
                   <div class="form-group">
                  <div class="form-group">
                      <label class="col-sm-2 control-label">名称:</label>
                    <div class="col-sm-4">
                         <p class="form-control-static">{{infos.name}}</p>
                    </div>
                    <label class="col-sm-2 control-label">logo:</label>
                     <div class="col-sm-4">
                         <p class="form-control-static">
                         <img src="{{infos.logo}}" height="35px">
                        </p>
                    </div>
                 </div>
                 <div class="form-group">
                      <label class="col-sm-2 control-label">网址:</label>
                    <div class="col-sm-4">
                         <p class="form-control-static">
                         <a href="{{infos.url}}">{{infos.url}}</a>
                        </p>
                    </div>
                    <label class="col-sm-2 control-label">排序:</label>
                     <div class="col-sm-4">
                         <p class="form-control-static">
                         {{infos.sort}}
                        </p>
                    </div>
                 </div>
                <div class="form-group">
                      <label class="col-sm-2 control-label">是否显示:</label>
                    <div class="col-sm-4">
                         <p class="form-control-static">
                         {{if infos.is_show==1}}
                         是
                         {{else}}
                         否
                         {{/if}}
                        </p>
                    </div>
                 </div>
                 <div class="form-group">
                      <label class="col-sm-2 control-label">描述:</label>
                    <div class="col-sm-4">
                         <p class="form-control-static">
                            {{infos.remarks}}
                        </p>
                    </div>
                 </div>
                </form>
            </div>
            <div class="box-footer">
                <label class="col-sm-1 control-label"></label>
                <a href="?ctl=<?=snow\req::item('ctl')?>&act=edit&id={{infos.id}}&back=infos" class="btn btn-sm btn-primary">
                    <i class="fa fa-fw fa-edit"></i>编辑
                </a>
                 <a href="?ctl=<?=snow\req::item('ctl')?>&act=del&id={{infos.id}}" class="btn  btn-sm  btn-danger">
                    <i class="fa fa-fw fa-remove"></i>移除
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