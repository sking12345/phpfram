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
            <li><a href="?ctl=<?=snow\req::item('ctl')?>&act=index"><i class="fa fa-fw fa-search"></i>商品列表</a></li>
             <li><a href="?ctl=<?=snow\req::item('ctl')?>&act=infos&id=<?=snow\req::item('id')?>">
                <i class="fa fa-fw fa-search"></i>查看商品信息</a>
            </li>
            <li class="active"><i class="fa fa-fw fa-search"></i>编辑详细信息</li>
        </ul>
        <form class="form-horizontal" method="POST">
            <?=snow\tpl::from_token()?>
            <script type="text/html" id="edit_infos">
            <div class="box content" style="min-height:100px">
                <div class="box-body">
                    
                    <div class="form-group">
                        <textarea id="edit_details" rows="10" name="details" class="form-control">
                            {{infos.details}}
                        </textarea>
                    </div>
                   
                <div class="box-footer">
                    <label class="col-sm-2 control-label"></label>
                    <button type="submit" class="btn btn-info">提交</button>
                </div>
            </div>
        </script>
        </form>
    </div>
    <div id="msg" class="hidden">
        <?=snow\tpl::get_json_assign()?>
    </div>
    <script src="public/components/jquery/dist/jquery.min.js"></script>
    <script src="public/js/verifyform.js"></script>
    <script src="public/components/bootstrap/dist/js/bootstrap.min.js"></script>
     <script src="public/components/ckeditor/ckeditor.js"></script>
    <script src="public/dist/js/adminlte.min.js"></script>
    <script src="public/js/template-web.js"></script>
    <script src="public/js/main.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        rendering('msg', true);
        CKEDITOR.replace('edit_details');
    });
    </script>
</body>

</html>