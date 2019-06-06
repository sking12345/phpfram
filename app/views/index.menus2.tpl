<aside class="main-sidebar" >
    <section class="sidebar" style="background-color:#222d32">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?=snow\user::$instance->get('img')?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?=snow\user::$instance->get('username')?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
         <ul class="sidebar-menu" data-widget="tree">
            <script type="text/html" id='menus'>
                {{each menus as val i}}
                
                     <li class="treeview" id="{{val.id}}">
                    <a href="#">
                      <i class="{{val.style}}"></i> <span>{{val.name}}</span>
                    </a>

                </li>
          {{/each}}
        
        </script>
        </ul>
    </section>
</aside>
<div style="z-index: 1000;position: absolute;top: 90px;">
    <script type="text/html" id='menus_children'>
        {{each menus_children as item i}}
            <div id="menus-ul{{i}}" class=" hide menus-ul" style="width:150px;background-color: #f0f0f0;border-right: 1px solid #dddddd;min-height:400px">
                 {{each item as val v}}
                 <div style="height:30px;padding:5px">
                 <a href="?ctl={{val.ctl}}&act={{val.act}}" id="{{val.id}}"   class="menu-li"> {{val.name}}</a>
                 </div>
                 {{/each}}
            </div>
        {{/each}}
   
     </script>
</div>
