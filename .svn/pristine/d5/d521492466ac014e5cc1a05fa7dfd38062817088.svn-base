/**
 * 后台模块公共js
 */

define(function(require,exports,module){

	  require('form-ajax');
	 require('bootbox');

	//form Ajax submit
	$(function(){
		var ajaxFrom = $('#ajaxForm');
		ajaxFrom.ajaxForm({
			dataType:'json',
			success:function(data){
				if(data.status > 0  && data.url){
					bootbox.confirm(data.info,function(result){
						if(result){
							window.location.href = data.url;
							return false;
						}
					});
				}else{
					bootbox.alert({
						message:data.info,
						title: "提示信息",

					});
					return false;
				}
			}
		})
	})

	/**
	 * 时间对象的格式化;
	 */
	exports.format = function (time,format) {
		var _this = new Date(time);
		/*
		 * eg:format="YYYY-MM-dd hh:mm:ss";
		 */
		var o = {
			"M+" :_this.getMonth() + 1, // month
			"d+" :_this.getDate(), // day
			"h+" :_this.getHours(), // hour
			"m+" :_this.getMinutes(), // minute
			"s+" :_this.getSeconds(), // second
			"q+" :Math.floor((_this.getMonth() + 3) / 3), // quarter
			"S" :_this.getMilliseconds()
			// millisecond
		}

		if (/(y+)/.test(format)) {
			format = format.replace(RegExp.$1, (_this.getFullYear() + "")
				.substr(4 - RegExp.$1.length));
		}

		for ( var k in o) {
			if (new RegExp("(" + k + ")").test(format)) {
				format = format.replace(RegExp.$1, RegExp.$1.length == 1 ? o[k]
					: ("00" + o[k]).substr(("" + o[k]).length));
			}
		}
		return format;
	};
});




