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
        <div class="box">
            <div class="box-header with-border">
                <form method="GET" action="" class="form-inline">
                    <div class="form-group">
                        <input type="text" class="form-control " name="name" value="<?=snow\req::item('name')?>" placeholder="请输入用户组名">
                        <button type="submit" class="btn btn-default">搜索</button>
                    </div>
                    <div class="form-group  pull-right">
                        <a href="?ctl=admin_group&act=add" class="btn  btn-info"><i class="fa fa-plus-circle"></i>添加用户组</a>
                    </div>
                </form>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover dataTable text-center">
                    <thead>
                        <tr>
                            <th style="width: 100px">id</th>
                            <th>用户组名</th>
                            <th>用户数</th>
                            <th>创建时间</th>
                            <th width="200px">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <script type="text/html" id="admin_list">
                            {{each list as item i}}
                            <tr>
                                  <td>{{item.id}}</td>
                                  <td>{{item.name}}</td>
                                  <td> 0 </td>
                                
                                  <td>{{item.create_time}}</td>
                                  <td>
                                    <a href="?ctl=admin_group&act=infos&id={{item.id}}" class="btn  btn-info  btn-sm"><i class="fa fa-fw fa-search"></i>查看</a> 
                                    <a href="?ctl=admin_group&act=edit&id={{item.id}}" class="btn btn-primary  btn-sm"><i class="fa fa-fw fa-edit"></i>编辑</a>
                                   
                                  </td>
                              </tr>
                        {{/each}}
                        <tr>
                          <th colspan="10">
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