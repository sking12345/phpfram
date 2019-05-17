<!DOCTYPE html>
<html>

<head>
  <meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″> 
<meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        <li><a href="?ctl=<?=snow\req::item('ctl')?>&act=index"><i class="fa fa-fw fa-search"></i>类型列表</a></li>
        <li><a href="?ctl=<?=snow\req::item('ctl')?>&act=attr_index"><i class="fa fa-fw fa-search"></i>属性列表</a></li>
        <li class="active"><i class="fa fa-fw fa-search"></i>查看属性</li>
    </ul>
     <script type="text/html" id="infos">
    <form class="form-horizontal">
        <div class="box content" style="min-height:100px">
            <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">属性名称:</label>
                    <div class="col-sm-4">
                          <p class="form-control-static">{{infos.name}}</p>
                    </div>
                 <label class="col-sm-2 control-label">所属类型:</label>
                    <div class="col-sm-4">
                        <p class="form-control-static">{{genre.name}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">可选属性:</label>
                    <div class="col-sm-4">
                          <p class="form-control-static">{{infos.select_list}}</p>
                    </div>
                 <label class="col-sm-2 control-label">可选方式:</label>
                    <div class="col-sm-4">
                        <p class="form-control-static">
                          {{if infos.select_type==1}}
                            单选
                          {{else}}
                          多选
                          {{/if}}
                      </p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">描述:</label>
                    <div class="col-sm-4">
                          <p class="form-control-static">{{infos.remarks}}</p>
                    </div>
                </div>
             </div>
            <div class="box-footer">
                <label class="col-sm-1 control-label"></label>
                  <a href="?ctl=<?=snow\req::item('ctl')?>&act=attr_edit&id={{infos.id}}&back=attr_infos&genre_id={{infos.genre_id}}" class="btn btn-sm btn-primary">
                    <i class="fa fa-fw fa-edit"></i>编辑
                </a>
                 <a href="?ctl=<?=snow\req::item('ctl')?>&act=attr_del&id={{infos.id}}&genre_id={{infos.genre_id}}" class="btn  btn-sm  btn-danger">
                    <i class="fa fa-fw fa-remove"></i>删除
                </a>
            </div>
        </div>
    </form>
    </script>
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
