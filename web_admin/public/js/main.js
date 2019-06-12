/*cookie处理*/ ! function(e) {
    var n = !1;
    if ("function" == typeof define && define.amd && (define(e), n = !0), "object" == typeof exports && (module.exports = e(), n = !0), !n) {
        var o = window.Cookies,
            t = window.Cookies = e();
        t.noConflict = function() { return window.Cookies = o, t }
    }
}(function() {
    function g() { for (var e = 0, n = {}; e < arguments.length; e++) { var o = arguments[e]; for (var t in o) n[t] = o[t] } return n }
    return function e(l) {
        function C(e, n, o) {
            var t;
            if ("undefined" != typeof document) {
                if (1 < arguments.length) {
                    if ("number" == typeof(o = g({ path: "/" }, C.defaults, o)).expires) {
                        var r = new Date;
                        r.setMilliseconds(r.getMilliseconds() + 864e5 * o.expires), o.expires = r
                    }
                    o.expires = o.expires ? o.expires.toUTCString() : "";
                    try { t = JSON.stringify(n), /^[\{\[]/.test(t) && (n = t) } catch (e) {} n = l.write ? l.write(n, e) : encodeURIComponent(String(n)).replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g, decodeURIComponent), e = (e = (e = encodeURIComponent(String(e))).replace(/%(23|24|26|2B|5E|60|7C)/g, decodeURIComponent)).replace(/[\(\)]/g, escape);
                    var i = "";
                    for (var c in o) o[c] && (i += "; " + c, !0 !== o[c] && (i += "=" + o[c]));
                    return document.cookie = e + "=" + n + i
                }
                e || (t = {});
                for (var a = document.cookie ? document.cookie.split("; ") : [], s = /(%[0-9A-Z]{2})+/g, f = 0; f < a.length; f++) {
                    var p = a[f].split("="),
                        d = p.slice(1).join("=");
                    this.json || '"' !== d.charAt(0) || (d = d.slice(1, -1));
                    try {
                        var u = p[0].replace(s, decodeURIComponent);
                        if (d = l.read ? l.read(d, u) : l(d, u) || d.replace(s, decodeURIComponent), this.json) try { d = JSON.parse(d) } catch (e) {}
                        if (e === u) { t = d; break } e || (t[u] = d)
                    } catch (e) {}
                }
                return t
            }
        }
        return (C.set = C).get = function(e) { return C.call(C, e) }, C.getJSON = function() { return C.apply({ json: !0 }, [].slice.call(arguments)) }, C.defaults = {}, C.remove = function(e, n) { C(e, "", g(n, { expires: -1 })) }, C.withConverter = e, C
    }(function() {})
});

template.defaults.imports.empty = function (val) {
      if(val==[]||val==''||!val)
      {
       return true;
      }
      return false;
 };

template.defaults.imports.in_array = function (val,arr) {
     if($.inArray(val, arr)>=0)
     {
        return true;
     }
     return false;
 };
 template.defaults.imports.date_format = function (time,fmt) {
    var date = new Date(time*1000);
    var month = date.getMonth()+1;
    if(month<10)
    {
         month = "0"+month;
    }
    var o = {  
     "Y+": date.getFullYear(),
    "m+" : month,                 //月份   
    "d+" : (date.getDate()<10)?"0"+date.getDate():date.getDate(),                    //日   
    "h+" : (date.getHours()<10)?"0"+date.getHours():date.getHours(),                   //小时   
    "i+" : (date.getMinutes()<10)?"0"+date.getMinutes():date.getMinutes(),                 //分   
    "s+" : (date.getSeconds()<10)?"0"+date.getSeconds():date.getSeconds(),                 //秒   
    "q+" : Math.floor((date.getMonth()+3)/3), //季度   
    "S"  : date.getMilliseconds()             //毫秒   
  };   
  console.log(date.getHours());
  if(/(y+)/.test(fmt))   
    fmt=fmt.replace(RegExp.$1, (date.getFullYear()+"").substr(4 - RegExp.$1.length));   
  for(var k in o)   
    if(new RegExp("("+ k +")").test(fmt))   

  fmt = fmt.replace(RegExp.$1, (RegExp.$1.length==1) ? (o[k]) : (("00"+ o[k]).substr((""+ o[k]).length)));   
  return fmt;   
 };
 template.defaults.imports.date_format1 = function (time,fmt) {
    var date = time;
     var o = {     
     "m+" : Math.floor(date/60/60/24/12),                 //月份   
    "d+" : Math.floor(date/60/60/24),                    //日   
    "h+" : Math.floor(date/60/60),                   //小时   
    "i+" :  Math.floor(date/60),                 //分   
    "s+" : date%60,                 //秒   
  };   
  if(/(y+)/.test(fmt))   
    fmt=fmt.replace(RegExp.$1, (date.getFullYear()+"").substr(4 - RegExp.$1.length));   
  for(var k in o)   
    if(new RegExp("("+ k +")").test(fmt))   
  fmt = fmt.replace(RegExp.$1, (RegExp.$1.length==1) ? (o[k]) : (("00"+ o[k]).substr((""+ o[k]).length)));   
  return fmt;   
 };


function table_pages_hander() {
    $(".paginate_button").click(function() {
        var page = this.id;
        if (this.id == "next") {
            page = $(".table_page_num").attr("id");
        } else if (this.id == "previous") {
            page = 1;
        } else {
            page = this.id;
        }
        var href = window.location.href;
        var data = {};
        var t = $(this).serializeArray();
        $.each(t, function() {
            data[this.name] = this.value;
            href += "&" + this.name + "=" + this.value;
        });
        href += "&show_page=" + page;
        window.location.href = href;
    });
}



function form_hander() {
   var form_data = {};
  $("form").submit(function() {
         var data = {};
        if ($(this).attr("method") == "POST"||$(this).attr("method")=="post") {
            return true;
        }else{
           var href = window.location.href;
          var t = $(this).serializeArray();
          $.each(t, function() {
              data[this.name] = this.value;
              href += "&" + this.name + "=" + this.value;
          });
          window.location.href = href;
        }
        return false;
    });
  $(".Validform").each(function(){
      $(this).Validform({
            btnReset:".btn_reset",
            tiptype: 4,
            showAllError: true,
            tipSweep:true,
            label:".label",
            postonce:true,
            ignoreHidden:false,  //对hidden项不做验证
      });
      var ctl = $(this).find("[name=ctl]").val();
      var act = $(this).find("[name=act]").val()
      form_data = Cookies.get(ctl+"_"+act+"_from")
     if(form_data)
     {
        Cookies.remove(ctl+"_"+act+"_from", { path: '' })
        form_data = JSON.parse(form_data);
       $("input[type=checkbox]").attr('checked', false)
       $.each(form_data,function(index,item_data){
            var array_obj = document.getElementsByName(index+"[]");
           if(array_obj.length >0)
           {
               if($(array_obj).is("input"))
               {
                  $.each(item_data,function(index1,obj){
                    if($(array_obj).eq(index1).attr("type") == "checkbox")
                    {
                       $(array_obj).eq(index1).prop('checked', 'checked');
                    }else  if($(array_obj).eq(index1).attr("type") == "text")
                    {
                       $(array_obj).eq(index1).val(obj);
                    }
                  });
               }else if($(array_obj).is("select"))
               {
                   $.each(item_data,function(index1,obj){
                      $(array_obj).eq(index1).find("[value="+item_data+"]").attr("selected",true);
                  });
               }
           }else{
            if($("[name="+index+"]").is("input"))
            {
              if( $("input[name="+index+"]").attr("type")=="radio")
              {
                $("input[name="+index+"][value="+item_data+"]").attr('checked', 'checked');
              }else if( $("input[name="+index+"]").attr("type")=="checkbox"){
                $("input[name="+index+"][value="+item_data+"]").attr('checked', 'checked');
              }else{
                 $("input[name="+index+"]").val(item_data);
              }
            }else if($("[name="+index+"]").is("select"))
            {
               $("select[name="+index+"]").find("[value="+item_data+"]").attr("selected",true);

            }else if($("[name="+index+"]").is("textarea")){
               $("textarea[name="+index+"]").val(item_data);
            }
           }
       })
     }
  });
  return form_data;
}



function isJSON(str) {
    if (typeof str == 'string') {
        try {
            var obj=JSON.parse(str);
            if(typeof obj == 'object' && obj ){
                return true;
            }else{
                return false;
            }
        } catch(e) {
            return false;
        }
    }
}

function json_message(json_data,status)
{

}

function str_message(info,msg_status)
{
    if($("#show_message").length>0)
        {
            $("#show_message").text(info);
            return false;
        }
        if(msg_status==1)
        {
            var color_style = "bg-aqua";
        }else if(msg_status == -1){
            var color_style = "bg-yellow";
        }
        var err_html = '<div id="message" style="position:absolute;right:0px;top:10px;width: 300px;z-index:9000">';
        err_html+='<div class="col-xs-12">';
        err_html+='<div class="small-box '+color_style+'">';
        err_html+='<div class="inner">';
        err_html+=' <p>提醒:'+info+'</p>';
        err_html+='</div>';
        err_html+='</div>';
        err_html+='</div>';
        err_html+='</div>';
        $("body").append(err_html);
        window.setTimeout(function(){
        $("#message").fadeOut(4000);
        },1000);
        window.setTimeout(function(){
            $("#message").remove();
        },5500);
}

function message_hander() {
    var info = Cookies.get("msg");
    if (info) {
    	var msg_status = Cookies.get("msg_status");
    	Cookies.remove('msg', { path: '' })
		  Cookies.remove('msg_status', { path: '' })
        
         if(isJSON(info) == true)
         {
             var json_data = JSON.parse(info);
            json_message(json_data,msg_status);
         }else{
            str_message(info,msg_status);
         }
    }
}

var gload_json = {};
 template.defaults.escape = true;
function rendering(msg_id, is_delete) {
    var json_str = $("#" + msg_id).text();
    if (json_str) {
    	 var json_data = JSON.parse(json_str);
       gload_json = json_data;
	    $("script[type='text/html']").each(function() {
          if($(this).attr("render")!="no"&&$(this).attr("render")!="No")
          {
             var html = template(this.id, json_data);
          $(this).parent().append(html);
          }
	       
	    });
    }   
    table_pages_hander();
    message_hander();
    var from_data = form_hander();
    return from_data;
}


 var util = {
    ajax_post:function(url,$data,call_function)
    {
      alert("xx");
    },
    ajax_get:function(url,data,call_function,back_type)
    {
      if(!back_type)
      {
        back_type = "html"
      }
      $.get(url,data,call_function,back_type);
    },
    rendering_local:function(script_id,json_data,append_id)
    {
       var html = template(script_id, json_data);
       if(append_id)
       {
          $(append_id).append(html);
       }
       return html;
    },
    get_assign:function(key)
    {
      if(key)
      {
        return gload_json;
      }
      if(gload_json[key])
      {
        return gload_json[key];
      }
      return {};

    }
 }







