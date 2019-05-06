
! function(e) {
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
    "d+" : date.getDate(),                    //日   
    "h+" : date.getHours(),                   //小时   
    "i+" : date.getMinutes(),                 //分   
    "s+" : date.getSeconds(),                 //秒   
    "q+" : Math.floor((date.getMonth()+3)/3), //季度   
    "S"  : date.getMilliseconds()             //毫秒   
  };   
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



/**
 * [change_show_num 修改]
 * @param  {[type]} obj [description]
 * @return {[type]}     [description]
 */
function change_show_num(obj){
	var show_num = $(obj).val();
	var from_obj = $(obj).parents(".box").find("form");
	var len = $(from_obj).find("input[name=show_num]").length;
	if(len == 0)
	{
		$(from_obj).prepend('<input type="hidden" name="show_num" value="'+show_num+'">')
	}else{
		$(from_obj).find("input[name=show_num]").val(show_num);
	}
	from_obj.submit();
}

function change_show_page(show_page,obj)
{
	var from_obj = $(obj).parents(".box").find("form");
	var len = $(from_obj).find("input[name=show_page]").length;
	if(len == 0)
	{
		$(from_obj).prepend('<input type="hidden" name="show_page" value="'+show_page+'">')
	}else{
		$(from_obj).find("input[name=show_page]").val(show_page);
	}
	from_obj.submit();
}


$(document).ready(function(){
	var assign_data = $("#assign_data").text();
	$("#assign_data").remove();
	if(assign_data)
	{	var assign_data = JSON.parse(assign_data);
		 $("script[type='text/html']").each(function(){
		 var html = template(this.id,assign_data);
	 	var position = $(this).attr("position");
	 	switch(position)
	 	{
	 		case "append":$(this).parent().append(html);break;
	 		case "after":$(this).parent().after(html);break
	 		case "before":$(this).parent().before(html);break;
	 		default:$(this).parent().html(html);break;
	 	}
	 });
	};
	if($(".select2").length>0)
	{
	 $(".select2").select2();
	}
	var info = Cookies.get("message");
	if(info)
	{
		var  message_status = Cookies.get("message_status");
		Cookies.remove('message', { path: '' })
		Cookies.remove('message_status', { path: '' })
		if($("#show_message").length>0)
		{
			$("#show_message").text(info);
			return false;
		}
		if(message_status==1)
		{
			var color_style = "bg-aqua";
		}else if(message_status == -1){
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
});











