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
        <form class="form-horizontal Validform" method="POST" enctype="multipart/form-data">
            <?=snow\tpl::from_token()?>
            <div class="box content" style="min-height:100px">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" style="color: #444" data-toggle="tab">通用信息</a></li>
                    <li><a href="#detailed-description" style="color: #444" data-toggle="tab">详细信息</a></li>
                    <li><a href="#details" style="color: #444" data-toggle="tab">详情描述</a></li>
                    <li><a href="#product-attribute"  style="color: #444" data-toggle="tab">商品属性</a></li>
                    <li><a href="#product-album" style="color: #444" data-toggle="tab">商品相册</a></li>
                    <li><a href="#accessories" style="color: #444" data-toggle="tab">配件</a></li>
                </ul>
                <script type="text/html" id="infos">
                <div class="box-body tab-content">
                    <div class="active tab-pane" id="activity">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><code>*</code>名称:</label>
                            <div class="col-sm-4">
                                <input type="text" name="name" class="form-control" errormsg="请输入20个字内的名称" nullmsg="请输入名称" datatype="*" maxlength="20" placeholder="名称">
                            </div>
                            <label class="col-sm-2 control-label"><code>*</code>商品分类:</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="cate_id">
                                    <option value="">请选择分类</option>
                                    {{each cate_infos as item i}}
                                    <option value="{{item.id}}">{{item.cat_name}}</option>
                                    {{/each}}
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">商品货号:</label>
                            <div class="col-sm-4">
                                <input type="text" name="number" class="form-control" maxlength="40" placeholder="商品货号">
                                <span class="help-span">如果您不输入商品货号,则系统将自动生成一个唯一的货号</span>
                            </div>
                            <label class="col-sm-2 control-label">商品品牌:</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="brand_id">
                                    <option value="">请选择品牌</option>
                                    {{each brands as item i}}
                                     <option value="{{item.id}}">{{item.name}}</option>
                                    {{/each}}
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><code>*</code>供应商:</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="supplier_id">
                                    <option value="">请选择供应商</option>
                                    {{each suppliers as item i}}
                                     <option value="{{item.id}}">{{item.name}}</option>
                                    {{/each}}
                                </select>
                            </div>
                            <label class="col-sm-2 control-label">售价:</label>
                            <div class="col-sm-4">
                                <input type="text" name="shop_price" class="form-control" nullmsg="请输入售价" datatype="n" placeholder="售价">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">会员价格:</label>
                            <div class="col-sm-4">
                                <input type="text" name="member_price" class="form-control" nullmsg="会员价格" datatype="n" placeholder="会员价格">
                            </div>
                            <label class="col-sm-2 control-label">vip售价:</label>
                            <div class="col-sm-4">
                                <input type="text" name="vip_price" class="form-control" nullmsg="vip售价" datatype="n" placeholder="vip售价">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">促销价:</label>
                            <div class="col-sm-4">
                                <input type="number" name="promotion_price" class="form-control" placeholder="vip售价">
                            </div>
                            <label class="col-sm-2 control-label">促销日期:</label>
                            <div class="col-sm-4">
                                <div class="col-sm-6" style="padding: 0px">
                                    <input type="text" name="promotion_start_time" class="form-control datepicker" placeholder="促销开始日期">
                                </div>
                                <div class="col-sm-6" style="padding: 0px">
                                    <input type="text" name="promotion_end_time" class="form-control datepicker" placeholder="促销结束日期">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">商品缩略图:</label>
                            <div class="col-sm-4">
                               <p class="form-control-static">
                            <img src="" id="show_img" class="hide" height="50" width="50" align="middle" style="border-radius:50%">
                            <input type="file" name="img" accept="image/*" multiple="false">
                        </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">描述:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="remarks" style="resize: none;height: 100px" maxlength="250"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="detailed-description">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">商品重量:</label>
                            <div class="col-sm-4">
                                <div class="col-sm-8" style="padding-left: 0px">
                                <input type="text" class="form-control" value="" name="username" placeholder="商品重量">
                                </div>
                               <div class="col-sm-4" style="padding: 0px">
                                <select class="form-control">
                                    <option value="1">千克</option>
                                     <option value="2">克</option>
                                </select>
                               </div>
                            </div>
                             <label class="col-sm-2 control-label">商品库存数量:</label>
                             <div class="col-sm-4">
                                <input type="number" class="form-control"  value="1" name="username" placeholder="商品库存数量">
                             </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">库存警告数量:</label>
                             <div class="col-sm-4">
                                <input type="number" class="form-control"  value="1" name="username" placeholder="库存警告数量">
                             </div>
                             <label class="col-sm-2 control-label">加入推荐:</label>
                             <div class="col-sm-4 checkbox">
                                 <label>
                                  <input type="checkbox" name="cat_recommend[]" value="1">
                                  精品
                                </label>
                                <label>
                                  <input type="checkbox" name="cat_recommend[]" value="2">
                                  最新
                                </label>
                                 <label>
                                  <input type="checkbox" name="cat_recommend[]" value="3">
                                  热门
                                </label>
                             </div>
                        </div>
                        <div class="form-group">
                             <label class="col-sm-2 control-label">上架:</label>
                             <div class="col-sm-10">
                                <label><input type="checkbox" value="1" name="username" >
                                <span class="help-span">打勾表示允许销售，否则不允许销售。</span>
                            </label>
                             </div>
                        </div>
                        <div class="form-group">
                             <label class="col-sm-2 control-label">能作为普通商品销售:</label>
                             <div class="col-sm-10">
                                <label><input type="checkbox" value="1" name="username" >
                                <span class="help-span">打勾表示能作为普通商品销售，否则只能作为配件或赠品销售</span>
                                </label>
                             </div>
                        </div>
                         <div class="form-group">
                             <label class="col-sm-2 control-label">是否为免运费商品:</label>
                             <div class="col-sm-10">
                                <label><input type="checkbox" value="1" name="username" >
                                <span class="help-span">打勾表示此商品不会产生运费花销，否则按照正常运费计算。</span>
                                </label>
                             </div>
                        </div>
                        <div class="form-group">
                             <label class="col-sm-2 control-label">商品关键词:</label>
                             <div class="col-sm-10">
                                <div class="col-sm-6" style="padding-left: 0px">
                                 <input type="text" class="form-control"  value="1" name="username" placeholder="商品关键词">
                                 </div>
                                 <div class="col-sm-6" style="padding: 0px">
                                      <p class="form-control-static help-span">用|分隔</p>
                                 </div>
                             </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="details">
                        
                    </div>
                    <div class="tab-pane" id="product-attribute">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">商品类型:</label>
                            <div class="col-sm-4">
                                <select class="form-control">
                                    <option>请选择商品类型</option>
                                    {{each genre as item i}}
                                        <option value="{{item.id}}">{{item.name}}</option>
                                    {{/each}}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="product-album">
                        ddd
                    </div>
                    <div class="tab-pane" id="accessories">
                        ccc
                    </div>
                </div>
                <div class="box-footer">
                    <label class="col-sm-2 control-label"></label>
                    <button type="submit" class="btn btn-info">提交</button>
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
    <script src="public/dist/js/adminlte.min.js"></script>
    <script src="public/js/template-web.js"></script>
    <script src="public/js/main.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        rendering('msg', true);
        $('.datepicker').datepicker({
            language: "cn",
            autoclose: true,
            clearBtn: true, //清除按钮
            todayHighlight: true,
            format: "yyyy-mm-dd"
        });
        $("input[name=img]").change(function(){
        var files = this.files[0];
        console.log(files);
        var reader = new FileReader();
         reader.readAsDataURL(files);
         reader.onload=function(e){
            $('#show_img').get(0).src = e.target.result;
            $('#show_img').removeClass("hide");
         }
       
    })
    });
    </script>
</body>

</html>