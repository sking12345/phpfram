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

