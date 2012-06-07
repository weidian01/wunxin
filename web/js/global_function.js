var g = {
    'base_url':'http://www.wunxin.com',
    'cookie_prefix':'wunxin',
    'cookie_expire':864000

};

//ajax请求
g.ajax = function (url, parameter) {
    $.ajax({
        type:"POST",
        url:url,
        async:false,
        data:parameter,
        success:function (msgs) {
            msg = eval('(' + msgs + ')');
        }
    });
    return msg;
}

//获取check box 的值
g.getChechBoxValue = function (RadioName) {
    var obj;
    var data = new Array();
    obj = document.getElementsByName(RadioName);

    if (obj != null) {
        var count = 0;
        for (var i = 0; i < obj.length; i++) {
            if (obj[i].checked) {
                data[count] = obj[i].value;
                count++;
            }
        }
    }
    return data;
}

//获取radio值
g.getRadioValue = function (RadioName) {
    var obj;
    obj = document.getElementsByName(RadioName);
    if (obj != null) {
        var i;
        for (i = 0; i < obj.length; i++) {
            if (obj[i].checked) {
                return obj[i].value;
            }
        }
    }
    return null;
}

//获取URL参数值
g.request = function (paras) {
    var url = location.href;
    var paraString = url.substring(url.indexOf("?") + 1, url.length).split("&");
    var paraObj = {}
    for (i = 0; j = paraString[i]; i++) {
        paraObj[j.substring(0, j.indexOf("=")).toLowerCase()] = j.substring(j.indexOf("=") + 1, j.length);
    }
    var returnValue = paraObj[paras.toLowerCase()];
    if (typeof(returnValue) == "undefined") {
        return "";
    } else {
        return returnValue;
    }
}

//获取COOKIE
g.getCookie = function (name) {
    name = g.cookie_prefix + name;
    var search = name + "="
    if (document.cookie.length > 0) {
        offset = document.cookie.indexOf(search)
        if (offset != -1) {
            offset += search.length
            end = document.cookie.indexOf(";", offset)
            if (end == -1) end = document.cookie.length
            return unescape(document.cookie.substring(offset, end))
        } else return ""
    }
}

//设置COOKIE
g.setCookie = function (name, value) {
    name = g.cookie_prefix + name;
    var exp = new Date();
    exp.setTime(exp.getTime() + g.cookie_expire);
    document.cookie = name + "=" + value + "; expires=" + exp.toGMTString() + "; path=/";
}

//删除COOKIE
g.deleteCookie = function (name) {
    name = g.cookie_prefix + name;
    var exp = new Date();
    exp.setTime(exp.getTime() - 3600);
    var cVal = GetCookie(name);
    document.cookie = name + "=" + cVal + "; expires=" + exp.toGMTString();
}