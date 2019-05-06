

function wssocket(host) {
    this.host = host;
    this.onopen_function;
    this.onmessage_function;
    this.onclose_function;
    this.socketobj;
    this.open_call = function(call_function) {
        this.onopen_function = call_function;
    }
    this.message_call = function(call_function) {
    	this.onmessage_function = call_function;
    }
    this.close_call = function(call_function) {
    	 this.onclose_function = call_function;
    }

    this.send_msg = function(data)
    {
    	this.socketobj.send(data);
    }
    this.close = function()
    {
    	this.socketobj.close();
    }
    this.run = function() {
        try {
       		var obj = this;
             this.socketobj = new WebSocket(this.host);
            this.socketobj.onopen = function() {
            	if(typeof obj.onopen_function === "function")
            	{
            		obj.onopen_function();
            	}else{
            		console.log("连接成功");
            	}
            }
            this.socketobj.onmessage = function(e) {
            	if(typeof obj.onmessage_function === "function")
            	{
            		obj.onmessage_function(e.data);
            	}else{
            		console.log(e.data);
            	}
            }
            this.socketobj.onclose = function() {
            	if(typeof obj.onclose_function === "function")
            	{
            		obj.onclose_function();
            	}else{
            		console.log("关闭连接");
            	}
            }
            
        } catch (exception) {
        	console.log("error:");
        	console.log(exception);
        }
    }
}







