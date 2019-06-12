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
                        <input type="text" class="form-control " name="keyword" value="<?=snow\req::item('keyword')?>" placeholder="请输入名称">
                    </div>
                    <div class="form-group">
                    <select class="form-control " name="big_cate">
                       <script type="text/html" id="big_cate">
                               <option value=" ">请选择大类</option>
                               {{each big_cate as item i}}
                                  {{if item.code == "<?=snow\req::get('big_cate')?>"}}
                                    <option class="unit{{item.unit}} unit" selected="true" value="{{item.code}}">{{item.name}}</option>
                                  {{else}}
                                   <option class="unit{{item.unit}} unit" value="{{item.code}}">{{item.name}}</option>
                                  {{/if}}
                               {{/each}}
                        </script>
                         </select>
                    </div>
                     <div class="form-group">
                      <select class="form-control " name="small_cate">
                       <script type="text/html" id="small_cate">
                               <option value=" ">请选择小类</option>
                               {{each small_cate as item i}}
                               {{if item.code == "<?=snow\req::get('small_cate')?>"}}
                                    <option class="big_cate{{item.big_cate}} small_cate" selected="true"  value="{{item.code}}">{{item.name}}
                                    </option>
                                {{else}}
                                 {{if item.big_cate == "<?=snow\req::get('big_cate')?>"}}
                                 <option class="big_cate{{item.big_cate}} small_cate "  value="{{item.code}}">{{item.name}}
                                    </option>
                                    {{else}}
                                    <option class="big_cate{{item.big_cate}} small_cate hide"  value="{{item.code}}">{{item.name}}
                                    </option>
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
                        <a href="?ctl=<?=snow\req::get('ctl')?>&act=add_product_name" class="btn  btn-info"><i class="fa fa-plus-circle"></i>添加品名</a>
                    </div>
                </form>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover dataTable text-center">
                    <thead>
                        <tr>
                            <th style="width: 100px">id</th>
                            <th>品名</th>
                            <th>小类</th>
                            <th>大类</th>
                            <th>属性</th>
                            <th width="250px">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <script type="text/html" id="admin_list">
                        {{each list as item i}}
                        <tr>
                            <td>{{item.id}}</td>
                            <td>{{item.name}}</td>
                            <td>{{small_cate[item.code].name}}</td>
                            <td>{{big_cate[small_cate[item.code].big_cate].name}}</td>
                            <td>{{item.attrs}}</td>
                            <td>
                                <a href="?ctl=<?=snow\req::get('ctl')?>&act=edit_product_name&id={{item.id}}" class="btn btn-primary  btn-sm"><i class="fa fa-fw fa-edit"></i>编辑</a>
                    
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
            $("select[name=big_cate]").change(function(){
               var val =  $("select[name=big_cate]").find("option:selected").val();
                $(".small_cate").addClass("hide");
                $(".big_cate"+val).removeClass("hide");
             })
        });
        </script>
</body>
</html>


