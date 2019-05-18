<!DOCTYPE html>
<html>

<head>
  <meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″> 
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>添加供应商</title>
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
         <li><a href="?ctl=<?=snow\req::item('ctl')?>&act=infos&id=<?=snow\req::item('id')?>">
            <i class="fa fa-fw fa-search"></i>查看供应商</a></li>
        <li class="active"><i class="fa fa-fw fa-search"></i>编辑供应商</li>
    </ul>
    <form class="form-horizontal Validform" method="POST" ajax=true>
        <?=snow\tpl::from_token()?>

        <div class="box content" style="min-height:100px">
            <div class="box-body">
              <script type="text/html" id="infos">
                <div class="form-group">
                    <label class="col-sm-2 control-label"><code >*</code>名称:</label>
                    <div class="col-sm-4">
                         <input type="text" value="{{infos.name}}" class="form-control" errormsg="请输入20个字内的名称" nullmsg="请输入名称" datatype="*" maxlength="20" name="name" placeholder="名称">
                    </div>
                    <label class="col-sm-2 control-label"><code >*</code>办公电话:</label>
                     <div class="col-sm-4">
                         <input type="text" value="{{infos.tel}}" class="form-control"  name="tel" placeholder="办公电话">
                    </div>
                    
                </div>
                <div class="form-group">
                     <label class="col-sm-2 control-label"><code >*</code>联系人:</label>
                    <div class="col-sm-4">
                         <input type="text" value="{{infos.contact}}" class="form-control" errormsg="请输入联系人" nullmsg="请输入联系人" datatype="*" maxlength="6" name="contact" placeholder="联系人">
                    </div>
                    <label class="col-sm-2 control-label"><code >*</code>手机号:</label>
                     <div class="col-sm-4">
                         <input type="text" value="{{infos.phone}}"  class="form-control"  name="phone" placeholder="手机号">
                    </div>
                </div>

                <div class="form-group">
                     <label class="col-sm-2 control-label">地址:</label>
                     <div class="col-sm-10">
                         <input type="text" value="{{infos.addr}}" class="form-control"  name="addr" placeholder="地址">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">描述:</label>
                     <div class="col-sm-10">
                    <textarea class="form-control" name="remarks" style="resize: none;height: 100px" maxlength="250">{{infos.remarks}}</textarea>
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