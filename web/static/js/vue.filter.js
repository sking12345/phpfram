


Date.prototype.Format = function (fmt) {
    var o = {
    		"Y+": this.getUTCFullYear(), // 月份
            "M+": this.getMonth() + 1, // 月份
            "D+": this.getDate(), // 日
            "h+": this.getHours(), // 小时
            "i+": this.getMinutes(), // 分
            "s+": this.getSeconds(), // 秒
            "q+": Math.floor((this.getMonth() + 3) / 3), // 季度
            "S": this.getMilliseconds() // 毫秒
    };
    if (/(y+)/.test(fmt))
        fmt = fmt.replace(RegExp.$1, (this.getFullYear() + ""));
    for (var k in o)
        if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
    return fmt;
}


Vue.filter('dateFormat', function (daraStr, pattern = 'Y-M-D h:i:s') {
    if(parseInt(daraStr))
    {
        return new Date(parseInt(daraStr)*1000).Format(pattern);
    }
	
})

Vue.filter('dataFind',function(data_arr,index_key,index1_key){
    if(data_arr[index_key])
    {
        if(index1_key)
        {
             if(data_arr[index_key][index1_key])
             {
               return data_arr[index_key][index1_key];
             }else{
                return null;
             }
        }
        return data_arr[index_key];
    }
    return null;
});