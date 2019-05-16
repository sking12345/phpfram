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
        <li><a href="?ctl=<?=snow\req::item('ctl')?>&act=index"><i class="fa fa-fw fa-search"></i>分类列表</a></li>
        <li><a href="?ctl=<?=snow\req::item('ctl')?>&act=infos&id=<?=snow\req::item('id')?>"><i class="fa fa-fw fa-search"></i>查看类型</a></li>
        <li class="active"><i class="fa fa-fw fa-search"></i>添加属性</li>
    </ul>
    <form class="form-horizontal Validform" method="POST" ajax=true>
        <?=snow\tpl::from_token()?>
         <input type="hidden" name="genre_id" value="<?=snow\req::item('id')?>">
        <div class="box content" style="min-height:100px">
            <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label"><code >*</code>属性名称:</label>
                    <div class="col-sm-4">
                         <input type="text" class="form-control" errormsg="请输入20个字内的属性名称" nullmsg="请输入属性名称" datatype="*" maxlength="20" name="name" placeholder="属性名称">
                    </div>
                 <label class="col-sm-2 control-label">商品类型:</label>
                    <div class="col-sm-4">
                        <p class="form-control-static"><?=snow\tpl::get_assign("name")?></p>
                    </div>
                </div>
                   <div class="form-group">
                    <label class="col-sm-2 control-label">录入方式:</label>
                    <div class="col-sm-10 radio">
                        <label class="col-sm-3">
                            <input type="radio" name="input_type" checked="true"  value="1"> 手工
                        </label>
                         <label class="col-sm-3">
                            <input type="radio" name="input_type"   value="2"> 从可选值单选
                        </label>
                       
                    </div>
                </div>
                 <div class="form-group">
                     <label class="col-sm-2 control-label">可选值列表:</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" name="select_list"  datatype="*" nullmsg="请输入可选值列表,多个属性已|分开" style="resize: none;height: 50px" maxlength="250"></textarea>
                    <span class="help-span">多个属性用|分开</span>
                    </div>
                </div>
              
                <div class="form-group">
                    <label class="col-sm-2 control-label">描述::</label>
                     <div class="col-sm-10">
                    <textarea class="form-control" name="remarks" style="resize: none;height: 100px" maxlength="250"></textarea>
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