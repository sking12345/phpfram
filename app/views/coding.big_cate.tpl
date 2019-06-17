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
                        <input type="text" class="form-control " name="keyword" value="<?=snow\req::get('keyword')?>" placeholder="请输入名称">
                    </div>
                    <div class="form-group">
                       <script type="text/html" id="kind">
                           <select class="form-control " name="kind">
                               <option value="">请选择种类</option>
                               {{each kinds as item i}}
                                {{if item.code =="<?=snow\req::item('kind')?>"}}
                                 <option value="{{item.code}}" selected="true">{{item.name}}</option>
                                {{else}}
                                <option value="{{item.code}}">{{item.name}}</option>
                                {{/if}}
                               {{/each}}
                           </select>
                       </script>
                    </div>
                    <div class="form-group">
                    <select class="form-control " name="unit_list">
                       <script type="text/html" id="unit_list">
                               <option value=" ">请选择事业部</option>
                               {{each unit_list as item i}}
                                {{if item.code =="<?=snow\req::item('unit_list')?>"}}
                                    {{if item.kinds == "<?=snow\req::item('kind')?>"}}
                                    <option class="kinds{{item.kinds}} kinds " value="{{item.code}}" selected="true">{{item.name}}</option>
                                    {{else}}
                                 <option class="kinds{{item.kinds}} kinds hide" value="{{item.code}}" selected="true">{{item.name}}</option>
                                    {{/if}}
                                {{else}}
                                    {{if item.kinds == "<?=snow\req::item('kind')?>"}}
                                   <option class="kinds{{item.kinds}} kinds " value="{{item.code}}">{{item.name}}</option>
                                    {{else}}
                                  <option class="kinds{{item.kinds}} kinds hide" value="{{item.code}}">{{item.name}}</option>
                                    {{/if}}
                                {{/if}}
                               {{/each}}
                         
                       </script>
                         </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default">搜索</button>
                    </div>
                    <div class="form-group  pull-right">
                        <a href="?ctl=<?=snow\req::get('ctl')?>&act=add_big_cate" class="btn  btn-info"><i class="fa fa-plus-circle"></i>添加大类</a>
                    </div>
                </form>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover dataTable text-center">
                    <thead>
                        <tr>
                            <th style="width: 100px">id</th>
                            <th>名称</th>
                            <th>种类</th>
                            <th>事业部</th>
                            <th>编号</th>
                            <th width="250px">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <script type="text/html" id="admin_list">
                        {{each list as item i}}
                        <tr>
                              <td>{{item.id}}</td>
                              <td>{{item.name}}</td>
                              <td>{{kinds[item.kinds].name}}</td>
                               <td>{{unit_list[item.unit].name}}</td>
                              <td>{{item.code}}</td>
                              <td>
                                <a href="?ctl=<?=snow\req::get('ctl')?>&act=edit_big_cate&id={{item.id}}" class="btn btn-primary  btn-sm"><i class="fa fa-fw fa-edit"></i>编辑</a>
                               
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
            $("select[name=kind]").change(function(){
                $("select[name=unit_list]").find("option[value=' ']").attr("selected",true);
                var kind_val =  $("select[name=kind]").find("option:selected").val();
                 $(".kinds").addClass("hide");
                $(".kinds"+kind_val).removeClass("hide");
            });
        });
        </script>
</body>

</html>