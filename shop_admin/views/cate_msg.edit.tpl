<!DOCTYPE html>
<html>

<head>
    <meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
            <li><i class="fa fa-fw fa-calendar-check-o"></i>分类管理</li>
            <li><a href="?ctl=<?=snow\req::item('ctl')?>&act=index"><i class="fa fa-fw fa-search"></i>分类列表</a></li>
            <li><a href="?ctl=<?=snow\req::item('ctl')?>&act=infos&id=<?=snow\req::item('id')?>"><i class="fa fa-fw fa-search"></i>查看分类</a></li>
            <li class="active"><i class="fa fa-fw fa-search"></i>编辑分类</li>
        </ul>
        <form class="form-horizontal Validform" method="POST" ajax=true>
          <script type="text/html" id="cate_infos">
            <?=snow\tpl::from_token()?>
          <div class="box content" style="min-height:100px">
            <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label"><code >*</code>分类名称:</label>
                    <div class="col-sm-4">
                         <input type="text" class="form-control" errormsg="请输入6个字内的分类名称" nullmsg="请输入分类名称" datatype="*" maxlength="6" value="{{infos.cat_name}}" name="cat_name" placeholder="分类名称">
                    </div>
                    <label class="col-sm-2 control-label">所属分类:</label>
                    <div class="col-sm-4">
                        <select  class="form-control" datatype="*" name="parent_id">
                        <option value="0">顶级分类</option>>
                        {{each cate_infos as item i}}
                        {{if infos.parent_id == item.id}}
                          <option value="{{item.id}}" selected="true">{{item.cat_name}}</option>
                        {{else}}
                        <option value="{{item.id}}">{{item.cat_name}}</option>
                        {{/if}}
                        {{/each}}
                         </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">数量单位:</label>
                    <div class="col-sm-4">
                         <input type="text" value="{{infos.measure_unit}}" class="form-control" value="" name="measure_unit" placeholder="数量单位">
                    </div>
                    <label class="col-sm-2 control-label">排序:</label>
                    <div class="col-sm-4">
                        <input type="number" value="{{infos.sort_order}}" class="form-control" value="50" name="sort_order" placeholder="排序">
                    </div>
                </div>
                 <div class="form-group">
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
                            {{if infos.is_show==2}}
                            <input type="radio" name="is_show" checked="true" value="2">否
                            {{else}}
                            <input type="radio" name="is_show"  value="2">否
                            {{/if}}
                            
                        </label>
                    </div>
                    <label class="col-sm-2 control-label">设置为首页推荐:</label>
                    <div class="col-sm-4 checkbox">
                            {{each recommend as item i}}
                            <label>
                              {{if infos.cat_recommend&i}}
                              <input type="checkbox" checked name="cat_recommend[]" value="{{i}}">
                              {{else}}
                              <input type="checkbox" name="cat_recommend[]" value="{{i}}">
                              {{/if}}
                            {{item}}
                          </label>
                      {{/each}}
                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">筛选属性:</label>
                    <div class="col-sm-4" id="genre_select_list">
                        {{each infos.genre_id as genre_item genre_i}}
                        <div class="select genre_select">
                          <div class="col-sm-5" style="padding:0px">
                            <select class="form-control" name="genre_id[]" onchange="change_cate(this)">
                            <option>选择商品类型</option>
                             {{each genre_infos as item i}}
                                {{if genre_item == item.id}}
                                    <option value="{{item.id}}" selected="true">{{item.name}}</option>
                                {{else}}
                                    <option value="{{item.id}}">{{item.name}}</option>
                               {{/if}}
                             {{/each}}
                         </select>
                       </div>
                        <div class="col-sm-5" style="padding-left:4px;padding-right: 0px">
                         <select class="form-control" name="filter_attr[]">
                           <option value="0">请选择筛选属性</option>
                           {{each genre_attr_arr[genre_item] as item i}}
                                {{if item.id == infos.filter_attr[genre_i]}}
                                    <option value="{{item.id}}" selected="true">{{item.name}}</option>
                                {{else}}
                                    <option value="{{item.id}}">{{item.name}}</option>
                                {{/if}}
                           {{/each}}
                         </select>
                       </div>
                        <div class="col-sm-1">
                            <p class="form-control-static">
                                {{if genre_i==0}}
                                 <a href="javascript:void(0)" onclick="add_attr()">[+]</a>
                                {{else}}
                                 <a href="javascript:void(0)" onclick="del_attr(this)">[-]</a>
                                {{/if}}
                            </p>
                        </div>
                      </div>
                      {{/each}}
                      <div id="genre_select" class="hide">
                        <div class="genre_select">
                        <div class="col-sm-5" style="padding:0px;margin-top: 4px">
                         <select class="form-control" name="genre_id[]" onchange="change_cate(this)">
                            <option>选择商品类型</option>
                             {{each genre_infos as item i}}
                               <option value="{{item.id}}">{{item.name}}</option>
                             {{/each}}
                  
                         </select>
                       </div>
                        <div class="col-sm-5" style="padding-left:4px;padding-right: 0px;margin-top: 4px">
                         <select class="form-control" name="filter_attr[]">
                           <option value="0">请选择筛选属性</option>
                         </select>
                       </div>
                        <div class="col-sm-1">
                            <p class="form-control-static">
                              <a href="javascript:void(0)" onclick="del_attr(this)">[-]</a>
                            </p>
                        </div>
                      </div>
                     </div>
                    </div>
                    <label class="col-sm-2 control-label">关键字:</label>
                    <div class="col-sm-4">
                         <input type="text" class="form-control"  name="keywords" placeholder="关键字">
                    </div>
                </div>
                
                 <div class="form-group">
                    <label class="col-sm-2 control-label">分类描述:</label>
                     <div class="col-sm-10">
                    <textarea class="form-control" value="{{infos.cat_desc}}" name="cat_desc" style="resize: none;height: 100px" maxlength="250"></textarea>
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
    var genre_select = "";
    function add_attr()
    {
      
       $("#genre_select_list").append(genre_select);
    }
    function del_attr(obj)
    {
      $(obj).parents(".genre_select").remove();

    }
    function change_cate(obj)
    {
          var id = $(obj).find("option:selected").val();
          var url = window.location.href+"&query=filter_attr";
          $.get(url,{"genre":id},function(data){
            var option = "<option>请选择筛选属性</option>";
            $.each(data.data,function(index,data_obj){
             option+="<option value='"+data_obj.id+"'>"+data_obj.name+"</option>";
            });
            $(obj).parent().next().find("select").html(option);
          },"JSON");
    }


    $(document).ready(function() {
        var from_data = rendering('msg', true);
        if(genre_select=="")
        {
          genre_select = $("#genre_select").html();
           $("#genre_select").remove();
         }
       if(from_data)
       {
          var url = window.location.href+"&query=filter_attr";
          for (var i = 0; i<from_data["genre_id"].length; i++) {
              if(i>=1)
              {
                $("#genre_select_list").append(genre_select);
              }
          }
          var gagenre_obj = document.getElementsByName("genre_id[]");
          $.each(from_data["genre_id"],function(index,item_data){
            $(gagenre_obj).eq(index).find("[value="+item_data+"]").attr("selected",true);
            var id = item_data;
            var url = window.location.href+"&query=filter_attr";
            $.get(url,{"genre":id},function(data){
              var option = "<option>请选择筛选属性</option>";
              $.each(data.data,function(index1,data_obj){
               if(data_obj.id == from_data["filter_attr"][index])
               {
                 option+="<option value='"+data_obj.id+"' selected='true'>"+data_obj.name+"</option>";
               }else{
                 option+="<option value='"+data_obj.id+"'>"+data_obj.name+"</option>";
               }
              });
              $(gagenre_obj).eq(index).parent().next().find("select").html(option);
            },"JSON");
          });
       } 
    });
    </script>
</body>

</html>