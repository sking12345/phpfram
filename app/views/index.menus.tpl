<aside class="main-sidebar">
    <section class="sidebar" style="background-color:#222d32">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?=snow\user::get('img')?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?=snow\user::get('username')?></p>
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
		          {{ if val.children.length>0 }} 
		          	 <li class="treeview" id="menus-li{{val.id}}">
		            <a href="#">
		              <i class="{{val.style}}"></i> <span>{{val.name}}</span>
		              <span class="pull-right-container">
		                <i class="fa fa-angle-left pull-right"></i>
		              </span>
		            </a>

		           <ul class="treeview-menu">
		          {{each val.children as val1 i1}}
                        {{if val1.default == 1}}
		                <li class="active active-menu-li" parent_id="{{val1.parent_id}}" >
                         <a href="?ctl={{val1.ctl}}&act={{val1.act}}" id="{{val1.id}}" class="menu-li active-li-a"><i class="fa fa-circle-o"></i> {{val1.name}}</a></li>
                        {{else}}
                         <li class="">
                          <a href="?ctl={{val1.ctl}}&act={{val1.act}}" id="{{val1.id}}" class="menu-li"><i class="fa fa-circle-o"></i> {{val1.name}}</a></li>
                        {{/if}} 
		          {{/each}}
		           </ul>
		          {{/if}}
        		</li>
          {{/each}}
        
        </script>
        </ul>
    </section>
</aside>
