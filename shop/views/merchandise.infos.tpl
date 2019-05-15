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
            <li class="active"><i class="fa fa-fw fa-search"></i>查看商品信息</li>
            <div class="pull-right">
                 <a href="?ctl=<?=snow\req::item('ctl')?>&act=edit_details&id=<?=snow\req::item('id')?>" class="btn  btn-sm btn-info">
                            <i class="fa fa-plus-circle"></i>设置详细描述
                </a>
            </div>
        </ul>
        
        <form class="form-horizontal">
            <div class="box content" style="min-height:100px">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" style="color: #444" data-toggle="tab">通用信息</a></li>
                    <li><a href="#detailed-description" style="color: #444" data-toggle="tab">其他信息</a></li>
                   <!--  <li><a href="#details" style="color: #444" data-toggle="tab">详情描述</a></li> -->
                    <li><a href="#product-attribute"  style="color: #444" data-toggle="tab">商品属性</a></li>
                    <li><a href="#product-album" style="color: #444" data-toggle="tab">商品相册</a></li>
                    <!-- <li><a href="#accessories" style="color: #444" data-toggle="tab">配件</a></li> -->
                </ul>
                <script type="text/html" id="infos">
                <div class="box-body tab-content">
                    <div class="active tab-pane" id="activity">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">名称:</label>
                            <div class="col-sm-4">
                                <p class="form-control-static">{{infos.name}}</p>
                            </div>
                            <label class="col-sm-2 control-label">商品分类:</label>
                            <div class="col-sm-4">
                                <p class="form-control-static">{{infos.cate_id}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">商品货号:</label>
                            <div class="col-sm-4">
                                 <p class="form-control-static">{{infos.number}}</p>
                            </div>
                            <label class="col-sm-2 control-label">商品品牌:</label>
                            <div class="col-sm-4">
                             
                                 <p class="form-control-static">{{infos.brand_id}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">供应商:</label>
                            <div class="col-sm-4">
                                <p class="form-control-static">{{infos.supplier_id}}</p>
                               
                            </div>
                            <label class="col-sm-2 control-label">售价:</label>
                            <div class="col-sm-4">
                                <p class="form-control-static">{{infos.shop_price}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">会员价格:</label>
                            <div class="col-sm-4">
                                <p class="form-control-static">{{infos.member_price}}</p>
                            </div>
                            <label class="col-sm-2 control-label">vip售价:</label>
                            <div class="col-sm-4">
                                 <p class="form-control-static">{{infos.vip_price}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">促销价:</label>
                            <div class="col-sm-4">
                                 <p class="form-control-static">{{infos.promotion_price}}</p>
                            </div>
                            <label class="col-sm-2 control-label">促销日期:</label>
                            <div class="col-sm-4">
                                <div class="col-sm-6" style="padding: 0px">
                                     <p class="form-control-static">开始日前 {{infos.promotion_start_time|date_format 'Y-m-d'}}</p>
                                     <p class="form-control-static">结束日期 {{infos.promotion_end_time|date_format 'Y-m-d'}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">描述:</label>
                            <div class="col-sm-10">
                                 <p class="form-control-static">{{infos.remarks}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="detailed-description">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">商品重量:</label>
                            <div class="col-sm-4">
                                <div class="col-sm-8" style="padding-left: 0px">
                                 <p class="form-control-static">{{infos.weight}} {{infos.weight_type}}</p>
                                </div>
                            </div>
                             <label class="col-sm-2 control-label">商品库存数量:</label>
                             <div class="col-sm-4">
                                 <p class="form-control-static">{{infos.stock_num}}</p>
                             </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">库存警告数量:</label>
                             <div class="col-sm-4">
                                 <p class="form-control-static">{{infos.stock_waring_num}}</p>
                             </div>
                             <label class="col-sm-2 control-label">加入推荐:</label>
                             <div class="col-sm-4 checkbox">
                                {{each recommend as item i}}
                                <label>
                                  <input type="checkbox" name="recommend[]" value="{{i}}">
                                  {{item}}
                                </label>
                                {{/each}}
                                 
                             </div>
                        </div>
                        <div class="form-group">
                             <label class="col-sm-2 control-label">上架:</label>
                             <div class="col-sm-10">
                                <label>
                                    {{if infos.is_shelf == 1}}
                                     <input type="checkbox" disabled="true" checked="true"  name="is_shelf" >
                                    {{else}}
                                     <input type="checkbox" disabled="true"  name="is_shelf" >
                                    {{/if}}
                                   
                                <span class="help-span">打勾表示允许销售，否则不允许销售。</span>
                            </label>
                             </div>
                        </div>
                        <div class="form-group">
                             <label class="col-sm-2 control-label">能作为普通商品销售:</label>
                             <div class="col-sm-10">
                                <label>
                                    
                                     {{if infos.is_general_goods == 1}}
                                     <input type="checkbox" disabled="true" checked="true"  name="is_general_goods" >
                                    {{else}}
                                     <input type="checkbox" disabled="true"  name="is_general_goods" >
                                    {{/if}}
                                <span class="help-span">打勾表示能作为普通商品销售，否则只能作为配件或赠品销售</span>
                                </label>
                             </div>
                        </div>
                         <div class="form-group">
                             <label class="col-sm-2 control-label">是否为免运费商品:</label>
                             <div class="col-sm-10">
                                <label>
                                      {{if infos.is_free_shipping == 1}}
                                     <input type="checkbox" disabled="true" checked="true"  name="is_free_shipping" >
                                    {{else}}
                                     <input type="checkbox" disabled="true"  name="is_free_shipping" >
                                    {{/if}}
                                <span class="help-span">打勾表示此商品不会产生运费花销，否则按照正常运费计算。</span>
                                </label>
                             </div>
                        </div>

                        <div class="form-group">
                             <label class="col-sm-2 control-label">商品关键词:</label>
                             <div class="col-sm-10">
                                <div class="col-sm-6" style="padding-left: 0px">
                                    <p class="form-control-static">{{infos.keyword}}<span class="help-span">(多个用|分隔)</span></p>
                                 </div>
                             </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="details">
                        <textarea id="edit_details" rows="10" name="product_details" class="form-control"></textarea>
                    </div>
                    <div class="tab-pane" id="product-attribute">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">商品类型:</label>
                            <div class="col-sm-4">
                                  <p class="form-control-static">{{infos.genre_id}}</p>
                            </div>
                        </div>
                        <div id="genre_attr_input">
                            {{each merchandise_attrs as item i}}
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{{genre_attrs[item.attr_id].name}}:</label>
                                    <div class="col-sm-4">
                                          <p class="form-control-static">{{item.attr_val}}</p>
                                    </div>
                                </div>
                            {{/each}}
                        </div>
                    </div>
                    <div class="tab-pane" id="product-album">
                        <div class="form-group">
                        {{each merchandise_imgs as item i}}
                        <div class="col-sm-2"  style="padding: 1px;margin: 1px;">
                          <img src="{{item.url}}" class="col-sm-12">
                          <p style="padding-left: 10px">
                            {{if item.remarks}}
                              描述:{{item.remarks}}
                              {{elae}}
                          {{/if}}
                          </p>
                        </div>
                        {{/each}}
                            
                        </div>
        
                </div>
                <div class="box-footer">
                      <label class="col-sm-1 control-label"></label>
                        <a href="?ctl=<?=snow\req::item('ctl')?>&act=edit&id={{infos.id}}&back=infos" class="btn btn-sm btn-primary">
                            <i class="fa fa-fw fa-edit"></i>编辑
                        </a>
                       
                         <a href="?ctl=<?=snow\req::item('ctl')?>&act=del&id={{infos.id}}" class="btn  btn-sm  btn-danger">
                            <i class="fa fa-fw fa-remove"></i>移除
                        </a>
                </div>
                </script>
            </div>
        </form>
    </div>  
    </div>
    <div id="msg" class="hidden">
        <?=snow\tpl::get_json_assign()?>
    </div>
    <script src="public/components/jquery/dist/jquery.min.js"></script>
    <script src="public/js/verifyform.js"></script>
    <script src="public/components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="public/components/fastclick/lib/fastclick.js"></script>
    <script src="public/components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
    <!-- <script src="public/components/ckeditor/ckeditor.js"></script> -->
    <script src="public/dist/js/adminlte.min.js"></script>
    <script src="public/js/template-web.js"></script>
    <script src="public/js/main.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        rendering('msg', true);

        //CKEDITOR.replace('edit_details');
    });
    </script>
</body>
</html>




