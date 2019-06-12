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
        <li><a href="?ctl=<?=snow\req::get('ctl')?>&act=business_unit"><i class="fa fa-fw fa-user"></i>事业部</a></li>
        <li class="active"><i class="fa fa-plus-circle"></i>编辑事业部</li>
    </ol>
    <form class="form-horizontal Validform" method="POST" enctype="multipart/form-data" >
        <?=snow\tpl::from_token()?>
        <div class="box content" style="min-height:100px">
            <div class="box-body">
                <script type="text/html" id="code">
                    
                <div class="form-group">
                    <label class="col-sm-2 control-label">名称:</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" datatype="*" value="{{infos.name}}" name="name" placeholder="名称">
                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">种类:</label>
                    <div class="col-sm-4">
                        <select  class="form-control"  datatype="*" name="kind_id">
                            <option value="">选择种类</option>>
                            {{each kinds as item i}}
                                {{if item.code==infos.kinds}}
                                 <option value="{{item.id}}" selected="true">{{item.name}}</option>
                                {{else}}
                                    <option value="{{item.id}}">{{item.name}}</option>
                                {{/if}}
                            {{/each}}
                        </select>
                    
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-2 control-label">编号:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" datatype="n" maxlength="2" value="{{infos.code}}" name="code" placeholder="编号">
                    </div>
                </div>
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
<script src="public/js/verifyform.js"></script>
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