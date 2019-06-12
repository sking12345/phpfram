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
        <li><a href="?ctl=<?=snow\req::get('ctl')?>&act=small_cate"><i class="fa fa-fw fa-user"></i>小类</a></li>
        <li class="active"><i class="fa fa-plus-circle"></i>编辑小类</li>
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
                                {{if item.code==infos.kind_id}}
                                 <option value="{{item.id}}" selected="true" code="{{item.code}}">{{item.name}}</option>
                                {{else}}
                                 <option value="{{item.id}}" code="{{item.code}}">{{item.name}}</option>
                                {{/if}}
                            {{/each}}
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">事业部:</label>
                    <div class="col-sm-4">
                        <select  class="form-control"  datatype="*" name="business_units">
                            <option value="">选择事业部</option>>
                            {{each business_units as item i}}
                              {{if item.code==infos.business_units}}
                                <option class="business_units" code="{{item.code}}" selected="true" value="{{item.id}}" kind_id="{{item.kind_id}}">{{item.name}}</option>
                                {{else}}
                                 <option class="business_units" code="{{item.code}}" value="{{item.id}}" kind_id="{{item.kind_id}}">{{item.name}}</option>
                                {{/if}}
                            {{/each}}
                        </select>
                    </div>
                </div>
                      <div class="form-group">
                    <label class="col-sm-2 control-label">大类:</label>
                    <div class="col-sm-4">
                        <select  class="form-control"  datatype="*" name="big_cate">
                            <option value="">选择事业部</option>>
                            {{each big_cates as item i}}
                             {{if item.code==infos.big_cate}}
                                <option class="big_cate" selected="true" value="{{item.id}}" big_cate_id="{{item.big_cate}}">{{item.name}}</option>
                                {{else}}
                                 <option class="big_cate" value="{{item.id}}" big_cate_id="{{item.big_cate}}">{{item.name}}</option>
                                {{/if}}
                            {{/each}}
                        </select>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-2 control-label">编号:</label>
                    <div class="col-sm-4">
                        <input type="text" value="{{infos.code}}" class="form-control" datatype="n" maxlength="2" name="code" placeholder="编号">
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
    $("select[name=kind_id]").change(function(){
        var val =  $("select[name=kind_id]").find("option:selected").attr("code");
        $(".business_units").addClass("hide");
        $("option[kind_id="+val+"]").removeClass("hide");
    });
     $("select[name=business_units]").change(function(){
        var val =  $("select[name=business_units]").find("option:selected").attr("code");
        $(".big_cate").addClass("hide");
        $("option[big_cate_id="+val+"]").removeClass("hide");
    });

});
</script>
</body>
</html>







