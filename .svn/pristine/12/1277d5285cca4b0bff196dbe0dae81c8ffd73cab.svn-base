var api = (function () {

    var viewurl = window.location.pathname.toLowerCase();
    var maskapi = $('<div id="maskapi" style="display:none"><img src="' + site_root + '"./image/wait.gif" /></div>');
    $("body").append(maskapi);
    var Adapter = {
        send: function (ajaxData) {
            //console.log(ajaxData.url);
            $.ajax({
                type: ajaxData.type,
                url: ajaxData.url,
                data: ajaxData.data,
                cache: false,
                async: ajaxData.async,
                dataType: "json",
                beforeSend: function () {
                    if (viewurl != "/account/login") {
                        maskapi.show();
                    } else {
                        maskapi.hide();
                    }
                },
                success: function (data) {
                    maskapi.hide();
                    //console.log(data);
                    //alert('success==>'+data.code);
                    switch (data.errcode) {
                        case 0:
                            if (ajaxData.succ && typeof (ajaxData.succ) == "function") ajaxData.succ(data);
                            //maskapi.hide();
                            break;
                        case 1:
                            if (ajaxData.succ && typeof (ajaxData.succ) == "function") ajaxData.succ(data);
                            //maskapi.hide();
                            break;
                        default:
                            if (ajaxData.err && typeof (ajaxData.err) == "function") ajaxData.err(data);
                            //maskapi.hide();
                            break;
                    }
                },
                error: function (data) {
                    //console.log(data);
                    if (typeof (ajaxData.err) == "function") ajaxData.err(data);
                    maskapi.hide();
                }
            });
        },
        Revenue: {
            sevenhistory: function (options) {
                var ajaxData = {};
                ajaxData.type = "POST";
                ajaxData.url = site_root + "/index.php/revenue/seven-revenue";
                ajaxData.async = false;
                ajaxData.data = options.data;
                ajaxData.succ = options.succ;
                ajaxData.err = options.err;
                Adapter.send(ajaxData);
            },
        },
        Live: {
            checkInfo: function (options) {
                var ajaxData = {};
                ajaxData.type = "POST";
                ajaxData.url = site_root + "/index.php/live/room-no";
                ajaxData.async = false;
                ajaxData.data = options.data;
                ajaxData.succ = options.succ;
                ajaxData.err = options.err;
                Adapter.send(ajaxData);
            },
            checkInfo1: function (options) {
                var ajaxData = {};
                ajaxData.type = "POST";
                ajaxData.url = site_root + "/index.php/live/room-type";
                ajaxData.async = false;
                ajaxData.data = options.data;
                ajaxData.succ = options.succ;
                ajaxData.err = options.err;
                Adapter.send(ajaxData);
            }
        }
    };
    return Adapter;
})
();