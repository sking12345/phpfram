<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="public/components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="public/components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="public/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="public/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="public/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body>
    <div class="content">
      <ul class="breadcrumb" style="margin-bottom:5px;background:#FFF;padding-left:0px">
        <li><i class="fa fa-fw fa-calendar-check-o"></i>分类管理</li>
        <li class="active"><i class="fa fa-fw fa-search"></i>分类列表</li>
        <a href="?ctl=<?=snow\req::item('ctl')?>&act=add" class="btn btn-xs  btn-info pull-right"><i class="fa fa-plus-circle"></i>添加分类</a>
      </ul>
        <div class="box">
            <div class="box-header with-border">
                <form method="GET" action="" class="form-inline">
                    <div class="form-group">
                        <input type="text" class="form-control " name="username" value="<?=snow\req::item('username')?>" placeholder="请输入用户名">
                        <button type="submit" class="btn btn-default">搜索</button>
                    </div>
                </form>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover dataTable text-center">
                    <thead>
                        <tr>
                            <th>编号</th>
                            <th>分类名称</th>
                            <th>上级分类</th>
                            <th>商品数量</th>
                            <th>数量单位</th>
                            <th>导航栏</th>
                            <th>是否显示</th>
                            <th>价格分级</th>
                            <th>排序</th>
                    
                            <th width="250px">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <script type="text/html" id="admin_list">
                        {{each list as item i}}
                        <tr>
                            <td>{{item.id}}</td>
                            <td>{{item.cat_name}}</td>
                            <td>
                                {{if item.parent_id == 0}}
                                    顶级分类
                                {{else}}
                                {{list[item.parent_id].cat_name}}
                                {{/if}}
                            </td>
                            <td>0</td>
                            <td>{{item.measure_unit}}</td>
                            <td>
                                {{if item.show_in_nav==1}}
                                <img src="./public/img/yes.svg" width="20">
                                {{else}}
                                <img src="./public/img/no.svg" width="20">
                               {{/if}}
                            </td>
                            <td>
                                {{if item.is_show==1}}
                                <img src="./public/img/yes.svg" width="20">
                                {{else}}
                                <img src="./public/img/no.svg" width="20">
                               {{/if}}
                            </td>
                            <td>{{item.grade}}</td>
                            <td>{{item.sort_order}}</td>
                           
                            <td>
                            <a href="?ctl=<?=snow\req::item('ctl')?>&act=infos&id={{item.id}}" class="btn  btn-info  btn-xs">
                                <i class="fa fa-fw fa-search"></i>查看
                            </a> 
                            <a href="?ctl=<?=snow\req::item('ctl')?>&act=edit&id={{item.id}}" class="btn btn-primary  btn-xs">
                                <i class="fa fa-fw fa-edit"></i>编辑
                            </a>
                            <a href="?ctl=<?=snow\req::item('ctl')?>&act=transfer&id={{item.id}}" class="btn btn-warning  btn-xs">
                                <i class="fa fa-fw fa-refresh"></i>转移商品
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
        <div id="msg" class="hidden">
            <?=snow\tpl::get_json_assign()?>
        </div>
        <script src="public/components/jquery/dist/jquery.min.js"></script>
        <script src="public/components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="public/components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="public/components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="public/components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="public/components/fastclick/lib/fastclick.js"></script>
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