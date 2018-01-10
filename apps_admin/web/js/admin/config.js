/**
 * Created by Administrator on 2016/9/9.
 */

/**
 * sea.js config base
 * Created by Administrator on 2014/12/12.
 */



var alias = {

    "$": "libs/jquery/jquery.js",
    "jquery": "libs/jquery/jquery.js",
    "common": "common/common.js",
    "form-ajax": 'libs/jquery-form/jquery-form',
    "bootstrap": 'libs/bootstrap/dist/js/bootstrap.min.js',

    //date-time
    "bootstrap-date": 'libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
    "bootstrap-date-css": 'libs/bootstrap-datepicker/dist/css/bootstrap-datetimepicker.css',
    "bootstrap-time": 'libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js',
    "bootstrap-time-css": 'libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css',

    //Ueditor
    'ue': 'libs/ueditor/ueditor.all.min',
    'ue-config': 'libs/ueditor/ueditor.config.js',

    //Admin
    "admin-common": "common/admin-common.js",
    "ace-basics": "admin/js/src/ace.basics.js",
    "ace-extra": "admin/js/ace-extra.js",
    "ace-sidebar": "admin/js/src/ace.sidebar.js",
    "ace-submenu-hover": "admin/js/src/ace.submenu-hover.js",
    "ace-sidebar-scroll-1": "admin/js/src/ace.sidebar-scroll-1.js",
    "ace-min": "admin/js/src/ace.js",
    "dataTables": "admin/js/jquery.dataTables.min.js",
    "dataTables-bootstrap": "admin/js/jquery.dataTables.bootstrap.min.js",
    "bootbox": "admin/js/bootbox.min.js",
    "sel": "admin/js/jquery.cityselect.js",
    "cimi": "admin/js/city.min.js",
};

for (var i in alias) {
    alias[i] = hotel.seajsBase + alias[i]
}

seajs.config(
    {
        //别名配置
        alias: alias
    }
);

