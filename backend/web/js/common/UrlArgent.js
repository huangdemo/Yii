// 获取cookie
function getCookieValue(name) {
    return localStorage.getItem(name);
    /**获取cookie的值，根据cookie的键获取值**/
        //用处理字符串的方式查找到key对应value
    var name = escape(name);
    //读cookie属性，这将返回文档的所有cookie
    var allcookies = document.cookie;
    //查找名为name的cookie的开始位置
    name += "=";
    var pos = allcookies.indexOf(name);
    //如果找到了具有该名字的cookie，那么提取并使用它的值
    if (pos != -1) {                                             //如果pos值为-1则说明搜索"version="失败
        var start = pos + name.length;                  //cookie值开始的位置
        var end = allcookies.indexOf(";", start);        //从cookie值开始的位置起搜索第一个";"的位置,即cookie值结尾的位置
        if (end == -1) end = allcookies.length;        //如果end值为-1说明cookie列表里只有一个cookie
        var value = allcookies.substring(start, end); //提取cookie的值
        return (value);                           //对它解码
    } else {  //搜索失败，返回空字符串
        return "";
    }
}
__CreateJSPath = function (publicname) {
    var publicPath = location.href.substr(0,location.href.indexOf(publicname)+publicname.length);
    return publicPath;
}
// var publicBootPATH = __CreateJSPath("public/");
var  publicBootPATH = 'http://localhost/Yii/backend/web/';
// ChemUrl : 'http://localhost/bit/www/',


var UrlArgent = {
    ServerUrl: publicBootPATH,
    TOKEN: getCookieValue('token'),
    Parsed: false, //是否已解析
    Cache: {}, //缓存值
    ParseArg: function () {
        // 解析地址栏的参数值
        UrlArgent.Parsed = true;
        var url = location.search;
        if (-1 == url.indexOf('?')) return;

        var args = url.substr(1).split("&");
        for (var i = 0; i < args.length; i++) {
            var tmp = args[i];
            var pos = tmp.indexOf('=');
            if (-1 == pos) continue;
            UrlArgent.Cache[tmp.substr(0, pos)] = tmp.substr(pos + 1);
        }
    },
    GetItem: function (queryStringName, defaultVal) {
        // 获取单个项目的值  queryStringName大小写敏感，及区分大小写
        if (UrlArgent.Parsed == false) UrlArgent.ParseArg();

        return UrlArgent.Cache[queryStringName] || (typeof (defaultVal) == 'undefined' ? '' : defaultVal.toString());
    },
    GetItemIgnore: function (queryStringName, defaultVal) {
        // 获取单个项目的值  queryStringName忽略大小写
        if (UrlArgent.Parsed == false) UrlArgent.ParseArg();

        for (var k in UrlArgent.Cache) {
            if (UrlArgent.Cache.hasOwnProperty(k) == false) continue; //只取私有属性
            if (k.toLowerCase() == queryStringName.toLowerCase()) return UrlArgent.Cache[k];
        }

        return (typeof (defaultVal) == 'undefined' ? '' : defaultVal.toString());
    },
    GetUrl: function (newValue, ignore, needCache) {
        // 获取url参数 newValue增加或修改的值  ignore关键字是否忽略大小写，true忽略大小写其他值大小写敏感
        if (typeof (newValue) != 'object') return location.search.substr(1); //原样返回

        if (UrlArgent.Parsed == false && needCache) UrlArgent.ParseArg();

        var url =[];
        if (needCache) {
            for (var k in UrlArgent.Cache) {
                if (UrlArgent.Cache.hasOwnProperty(k) == false) continue; //只取私有属性

                var val = UrlArgent.Cache[k]; //默认是原值
                for (var n in newValue) {
                    if (newValue.hasOwnProperty(n) == false) continue;

                    if ((k == n) || (ignore == true && k.toLowerCase() == n.toLowerCase())) { //需要替换原来的值
                        val = newValue[n].toString(); //赋新值
                        newValue[n] = null; //清除设置了值的项
                    }
                }
                url.push(k + '=' + val);
            }
        }

        for (var n in newValue) { //新增加的键值
            if (newValue.hasOwnProperty(n) == false) continue;
            if (newValue[n] == null) continue;
                url.push(n + '=' + newValue[n].toString());
        }
        return url.join('&');
    },
    CreateUrl: function (shortUrl, newValue, needToken, needIgnore, needCache) {//第一个参数是创建的参数{}形式，第二个是是否需要token,是否忽略大小写
        if (typeof (needToken) == 'undefined') needToken = true; //默认不忽略大小写
        if (typeof (newValue) == 'undefined') newValue = {}; //返回空
        if (needToken) newValue.token = this.TOKEN;//自定义的token值
        if (typeof (newValue) != 'object') return ''; //返回空
        if (typeof (needIgnore) == 'undefined') needIgnore = false; //默认不忽略大小写
        if (typeof (needCache) == 'undefined') needCache = false; //默认不需要cache
        var params = UrlArgent.GetUrl(newValue, needToken, needIgnore, needCache);
        // if(-1 == shortUrl.indexOf('?')){
        //     return UrlArgent.ServerUrl+shortUrl+".html?"+params;
        // } else{
        //     return UrlArgent.ServerUrl+shortUrl+"&"+params;
        // }
        return UrlArgent.ServerUrl + shortUrl + "?" + params;
    }
};













