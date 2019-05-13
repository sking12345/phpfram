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
            <li class="active"><i class="fa fa-fw fa-search"></i>添加类型</li>
        </ul>
       
            <div class="box content" style="min-height:100px">
            <script type="text/html" id="infos">
            <div class="box-body">
                <form class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label">类型名称:</label>
                    <div class="col-sm-4">
                         <p class="form-control-static">{{infos.name}}</p>
                    </div>
                  <label class="col-sm-2 control-label">状态:</label>
                    <div class="col-sm-4 radio">
                        <label class="col-sm-5">
                            {{if infos.enabled==1}}
                            <input type="radio" name="enabled" checked="true" disabled="true"  value="1">开启
                            {{else}}
                             <input type="radio" name="enabled" checked="true" disabled="true"  value="2">关闭
                            {{/if}}
                        </label>
                       
                    </div>
                </div>
                   <div class="form-group">
                    <label class="col-sm-2 control-label">属性数:</label>
                    <div class="col-sm-4">
                         <p class="form-control-static">{{infos.attr_num}}</p>
                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">描述::</label>
                     <div class="col-sm-10">
                         <p class="form-control-static">{{infos.remarks}}</p>
                    </div>
                 </div>
                </form>
            </div>
            <div class="box-footer">
                <label class="col-sm-1 control-label"></label>
                <a href="?ctl=<?=snow\req::item('ctl')?>&act=edit&id={{infos.id}}&back=infos" class="btn btn-sm btn-primary">
                    <i class="fa fa-fw fa-edit"></i>编辑
                </a>
                <a href="?ctl=<?=snow\req::item('ctl')?>&act=add_attr&id={{infos.id}}" class="btn  btn-sm btn-info">
                    <i class="fa fa-plus-circle"></i>添加属性列表
                </a>
                 <a href="?ctl=<?=snow\req::item('ctl')?>&act=del&id={{infos.id}}" class="btn  btn-sm  btn-danger">
                    <i class="fa fa-fw fa-remove"></i>删除
                </a>
            </div>
        </script>
        </div>
       <div class="box">
        <div class="box-header with-border">
            <form method="GET" action="" class="form-inline">
                <div class="form-group">
                    <input type="text" class="form-control " name="keyword" value="<?=snow\req::item('keyword')?>" placeholder="请输入名称">
                    <button type="submit" class="btn btn-default">搜索</button>
                </div>
            </form>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-hover dataTable text-center">
                <thead>
                    <tr>
                        <th width="200px">编号</th>
                        <th>属性名称</th>
                        <th>可选属性</th>
                        <th width="250px">操作</th>
                    </tr>
                </thead>
                <tbody>
                     <script type="text/html" id="attr_list">
                        {{each attr_list as item i}}
                        <tr>
                            <td>{{item.id}}</td>
                            <td>{{item.name}}</td>
                            <td>{{item.select_list}}</td>
                            <td>
                            <a href="?ctl=<?=snow\req::item('ctl')?>&act=edit_attr&id={{item.id}}&genre_id=<?=snow\req::item('id')?>" class="btn btn-primary  btn-xs">
                                <i class="fa fa-fw fa-edit"></i>编辑
                            </a>
                            <a href="?ctl=<?=snow\req::item('ctl')?>&act=del_attr&id={{item.id}}&genre_id=<?=snow\req::item('id')?>" class="btn  btn-xs  btn-sm  btn-danger">
                                <i class="fa fa-fw fa-remove"></i>删除
                            </a>
                            </td>
                        </tr>
                        {{/each}}
                        <tr>
                          <th colspan="20">
                             <?=\html::create_table_pages("public/table.pages.tpl","pages")?>
                          </th>
                        </tr>
                    </script>
                </tbody>
            </table>
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