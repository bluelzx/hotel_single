/**
 * Created by Administrator on 2016/1/20.
 */



var comm = {
    //全局请求
    runAjax: function (url, obj_json, succ) {
        var async = (arguments[3] === false) ? arguments[3] : true;
        //console.log(url);
        var settings = {
            type: 'post',
            url: url,
            data: obj_json,
            async: async,
            cache: false,
            dataType: "json",
            success: succ,
            error: function (data) {
                console.log(data);
            }
        };
        $.ajax(settings);
    }
}

//handerbar.js扩展函数
//比较函数
Handlebars.registerHelper("compare", function (v1, v2, options) {
    if (v1 == v2) {
        return options.fn(this);
    } else {
        return options.inverse(this);
    }
});
//任意一个有值
Handlebars.registerHelper("compareEther", function (v1, v2, options) {
    if (v1 || v2) {
        return options.fn(this);
    } else {
        return options.inverse(this);
    }
});
//数组长度不为0
Handlebars.registerHelper("emptyarray", function (v1, options) {
    if (v1 && v1.length && v1.length > 0) {
        return options.fn(this);
    } else {
        return options.inverse(this);
    }
});
