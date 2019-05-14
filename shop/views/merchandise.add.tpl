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
        <li class="active"><i class="fa fa-fw fa-search"></i>添加商品</li>
    </ul>
    <form class="form-horizontal Validform" method="POST" ajax=true>
        <?=snow\tpl::from_token()?>

        <div class="box content" style="min-height:100px">
            <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label"><code >*</code>名称:</label>
                    <div class="col-sm-4">
                         <input type="text" name="name" class="form-control" errormsg="请输入20个字内的名称" nullmsg="请输入名称" datatype="*" maxlength="20"  placeholder="名称">
                    </div>
                    <label class="col-sm-2 control-label"><code >*</code>商品分类:</label>
                    <div class="col-sm-4">
                         <select class="form-control" name="cate_id">
                             
                         </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">商品货号:</label>
                    <div class="col-sm-4">
                        <input type="text" name="number" class="form-control"  maxlength="40" placeholder="商品货号">
                        <span class="help-span">如果您不输入商品货号,则系统将自动生成一个唯一的货号</span>
                    </div>
                  <label class="col-sm-2 control-label">商品品牌:</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="brand_id">
                             
                         </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><code >*</code>供应商:</label>
                    <div class="col-sm-4">
                         <select class="form-control" name="supplier_id">
                             
                         </select>
                    </div>
                    <label class="col-sm-2 control-label">售价:</label>
                    <div class="col-sm-4">
                        <input type="text" name="shop_price" class="form-control"  nullmsg="请输入售价" datatype="n"  placeholder="售价">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">会员价格:</label>
                    <div class="col-sm-4">
                          <input type="text" name="member_price" class="form-control"  nullmsg="会员价格" datatype="n"  placeholder="会员价格">
                    </div>
                    <label class="col-sm-2 control-label">vip售价:</label>
                    <div class="col-sm-4">
                        <input type="text" name="vip_price" class="form-control"  nullmsg="vip售价" datatype="n"  placeholder="vip售价">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">促销价:</label>
                    <div class="col-sm-4">
                        <input type="number" name="promotion_price" class="form-control"   placeholder="vip售价">
                    </div>
                    <label class="col-sm-2 control-label">促销日期:</label>
                    <div class="col-sm-4">
                       <div class="col-sm-6" style="padding: 0px">
                        <input type="text" name="promotion_start_time" class="form-control datepicker" placeholder="促销开始日期">
                       </div>
                       <div class="col-sm-6" style="padding: 0px">
                        <input type="text" name="promotion_end_time" class="form-control datepicker"  placeholder="促销结束日期">
                       </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">商品缩略图:</label>
                    <div class="col-sm-4">
                          <input type="file" name="img" nullmsg="请选择商品缩略图" datatype="*">
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
<script src="public/components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
<script src="public/dist/js/adminlte.min.js"></script>
<script src="public/js/template-web.js"></script>
<script src="public/js/main.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    rendering('msg', true);
    $('.datepicker').datepicker({
        language: "cn",
        autoclose: true,
        clearBtn: true,//清除按钮
        todayHighlight : true,
        format: "yyyy-mm-dd"
    });
});
</script>
</body>

</html>