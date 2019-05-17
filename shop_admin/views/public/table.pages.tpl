

{{if <?=$parames?>.page_num<=0}}
  <div class="text-center">
    <span style="font-weight:400">没有更多数据</span>
  </div>
{{else}}
<div class="pull-right">
    <div class="dataTables_paginate paging_simple_numbers">
        <ul class="pagination table_page_num" style="margin:0px" id="{{<?=$parames?>.page_num}}">
            <li class="paginate_button previous" id="previous">
                <a data-dt-idx="0" >首页</a></li>
                  <!-- <li class="paginate_button active"> -->
           {{ if <?=$parames?>.show_page -3 > 1 }}
             <li class="paginate_button">
                <a  >...</a>
            </li>
           {{/if}}
           <% for(i=<?=$parames?>.start_page;i<=<?=$parames?>.end_page;i++){%>
            
             {{ if <?=$parames?>.show_page == i }}
              <li class="paginate_button active" id="<%=i%>" >
                {{else}}
                <li class="paginate_button" id="<%=i%>">
             {{/if}}
                <a  ><%=i%></a>
            </li>
           <%}%>
                  <!-- <li class="paginate_button active"> -->
           {{ if <?=$parames?>.show_page  < <?=$parames?>.page_num - 3 }}
             <li class="paginate_button">
                <a  >...</a>
            </li>
           {{/if}}     
           
            <li class="paginate_button next" id="next">
                <a >尾页</a>
            </li>
        </ul>
    </div>
</div>
{{/if}}