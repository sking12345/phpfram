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
            <li><i class="fa fa-fw fa-calendar-check-o"></i>商品品牌</li>
            <li><a href="?ctl=<?=snow\req::item('ctl')?>&act=index"><i class="fa fa-fw fa-search"></i>品牌列表</a></li>
            <li class="active"><i class="fa fa-fw fa-search"></i>添加分类</li>
        </ul>
        <form class="form-horizontal Validform" method="POST" enctype="multipart/form-data">
            <?=snow\tpl::from_token()?>
            <script type="text/html" id="edit_infos">
            <div class="box content" style="min-height:100px">
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><code>*</code>品牌名称:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" errormsg="请输入6个字内的品牌名称" nullmsg="请输入品牌名称" datatype="*" maxlength="6" name="name" value="{{infos.name}}" placeholder="品牌名称">
                        </div>
                        <label class="col-sm-2 control-label">品牌网址:</label>
                        <div class="col-sm-4">
                            <input type="text" value="{{infos.url}}" class="form-control" name="url" placeholder="品牌网址">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">排序:</label>
                        <div class="col-sm-4">
                            <input type="text" datatype="n" value="{{infos.sort}}" class="form-control" name="sort" placeholder="排序">
                        </div>
                        <label class="col-sm-2 control-label">是否显示:</label>
                        <div class="col-sm-4 radio">
                            <label class="col-sm-5">
                                {{if infos.is_show==1}}
                                 <input type="radio" name="is_show" checked="true" value="1">是
                                {{else}}
                                <input type="radio" name="is_show"  value="1">是
                                {{/if}}
                            </label>
                            <label class="col-sm-5">
                                 {{if infos.is_show==1}}
                                <input type="radio" name="is_show" checked="true" value="2">否
                                {{else}}
                                 <input type="radio" name="is_show" value="2">否
                                {{/if}}
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">品牌LOGO:</label>
                        <div class="col-sm-4">
                             <img src="{{infos.logo}}" id="show_img"  height="50"  align="middle">
                            <input type="file"  name="logo" accept="image/*" multiple="false">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">描述:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="remarks" style="resize: none;height: 100px" maxlength="250">{{infos.remarks}}</textarea>
                        </div>
                    </div>
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
    <script src="public/dist/js/adminlte.min.js"></script>
    <script src="public/js/template-web.js"></script>
    <script src="public/js/main.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        rendering('msg', true);
        $("input[name=logo]").change(function(){
        var files = this.files[0];
        console.log(files);
        var reader = new FileReader();
        reader.readAsDataURL(files);
        reader.onload=function(e){
            $('#show_img').get(0).src = e.target.result;
            $('#show_img').removeClass("hide");
         }
        });
    });
    </script>
</body>

</html>