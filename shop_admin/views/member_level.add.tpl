<!DOCTYPE html>
<html>

<head>
  <meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″> 
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>添加分类</title>
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
        <li><i class="fa fa-fw fa-calendar-check-o"></i>会员管理</li>
        <li><a href="?ctl=<?=snow\req::item('ctl')?>&act=index"><i class="fa fa-fw fa-search"></i>等级列表</a></li>
        <li class="active"><i class="fa fa-fw fa-search"></i>添等级</li>
    </ul>
    <form class="form-horizontal Validform" method="POST" ajax=true>
        <?=snow\tpl::from_token()?>
        <div class="box content" style="min-height:100px">
            <div class="box-body">
              <div class="form-group">
                    <label class="col-sm-2 control-label"><code >*</code>名称:</label>
                    <div class="col-sm-4">
                         <input type="text" class="form-control" errormsg="请输入6个字内的名称" nullmsg="请输入名称" datatype="*" maxlength="20" name="name" placeholder="名称">
                    </div>
                    <label class="col-sm-2 control-label">折扣率:</label>
                       <div class="col-sm-4 radio">
                      <input type="number" class="form-control" value="80" datatype="n" max="100" min="0" name="discount_rate" placeholder="名称">
                      <span class="help-span">请填写为0-100的整数,如填入80,表示折扣率为8折</span>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-2 control-label">积分下限:</label>
                    <div class="col-sm-4">
                         <input type="number" class="form-control" datatype="n" name="intergral_lower" placeholder="积分下限">
                    </div>
                    <label class="col-sm-2 control-label">积分上限:</label>
                       <div class="col-sm-4 radio">
                     <input type="number" class="form-control" datatype="n" name="intergral_top" placeholder="积分下限">
                    </div>
                </div>
           
             <div class="form-group">
              <label class="col-sm-2 control-label">备注:</label>
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
    var from_data = rendering('msg', true);    
});
</script>
</body>


</html>