// JavaScript Document
$(function()
{
    //点击input表单实现 全选或反选
    $("input.select_all").click(function () {
        $("[type='checkbox']").attr("checked",$(this).attr('checked')=='checked');
    })
    $(".menu-user").click(function(){
      $(this).toggleClass("li-open");
    });
})

function yh_ajax_post(postUrl, postData ,returnSuccess)
{
	var layerLoadIndex;
    var ajaxTimeoutTest = $.ajax({
        type : "POST",
        url : postUrl,
        timeout : 10000,
        cache : false,
        data : postData || {},
        beforeSend : function(){
        	layerLoadIndex = layer.load(2, {shade : [0.3, '#000']});
        },
		complete : function(XMLHttpRequest,status){ //请求完成后最终执行参数
			layer.close(layerLoadIndex);
			if(status=='timeout'){//超时,status还有success,error等值的情况
	 　　　　　 ajaxTimeoutTest.abort();
                layerMsg('请求超时，请重试');
                return false;
	　　　　}
　　　　},
		error : function(){
            layerMsg('请求出错，请重试');
            return false;
		},
        success : function(data) {
            if(data.substr(0, 1) == '{') {
            	var jsonData = jQuery.parseJSON(data);
                //判断是否登陆
                if(jsonData.errNum===7) {
                    layer.confirm('对不起您还没有登陆，现在去登陆？', {
                        btn: ['登陆','取消'] //按钮
                    }, function(){
                        yh_skip(jsonData.retData.loginUrl);
                    });
                    return false;
                }else{
                    //执行回调函数
                    returnSuccess(jsonData);
                }
            }else{
            	layerMsg('请求失败，请刷新后重试');
            }
        }
    })
    return false;
}


function yh_ajax_get(postUrl)
{
    var layerLoadIndex;
    var ajaxTimeoutTest = $.ajax({
        type : "get",
        url : postUrl,
        timeout : 10000,
        cache : false,
        beforeSend : function(){
            layerLoadIndex = layer.load(2, {shade : [0.5, '#fff']});
        },
        complete : function(XMLHttpRequest,status){ //请求完成后最终执行参数
            layer.close(layerLoadIndex);
            if(status=='timeout'){//超时,status还有success,error等值的情况
     　　　　　 ajaxTimeoutTest.abort();
                layerMsg('请求超时，请重试');
                return false;
    　　　　}
　　　　},
        error : function(){
            layerMsg('请求出错，请重试');
            return false;
        },
        success : function(data) {
            if(data.substr(0, 1) == '{') {
                var jsonData = jQuery.parseJSON(data);
                //判断是否登陆
                if(jsonData.errNum===7) {
                    layer.confirm('对不起您还没有登陆，现在去登陆？', {
                        btn: ['登陆','取消'] //按钮
                    }, function(){
                        yh_skip(jsonData.retData.loginUrl);
                    });
                    return false;
                }else if(jsonData.errNum===0){
                    layerMsg(jsonData.retMsg, 1, 1500, function(){ location.reload() });
                }else{
                    layerMsg(jsonData.retMsg);
                }
            }else{
                layerMsg('请求失败，请刷新后重试');
            }
        }
    })
    return false;
}

function layerMsg(msg, icon, time, fun)
{
    if(!arguments[0]) msg = '操作成功';
    if(!arguments[1]) icon = 2;
    if(!arguments[2]) time = 1500;
    if(!arguments[3]) fun = function(){
        return false
    }
    layer.msg(msg, {icon: icon,time: time, shade : [0.3, '#000']},function(){
        fun();
    });
}

function yh_skip(url)
{
    window.location.href=url;
}