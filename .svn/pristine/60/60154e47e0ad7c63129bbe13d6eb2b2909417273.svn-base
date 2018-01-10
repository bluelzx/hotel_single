/**
 */


define(function(require,exports,module){

	require('imgliquid');
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
						title: "提示信息"
					});
					return false;
				}
			}
		})
	})

	/**
	 * @author default7#zbphp.com
	 * @description 将ThinkPHP的分页转换为 bootstrap分页
	 * @param selector
	 */
	function initPagination(selector) {
		selector = selector || '.page';
		$(selector).removeClass("hidden");
		$(selector).each(function (i, o) {
			var html = '<ul class="pagination">';
			$(o).find('a,span').each(function (i2, o2) {
				var linkHtml = '';
				if ($(o2).is('a')) {
					linkHtml = '<a href="' + ($(o2).attr('href') || '#') + '">' + $(o2).text() + '</a>';
				} else if ($(o2).is('span')) {
					linkHtml = '<a>' + $(o2).text() + '</a>';
				}

				var css = '';
				if ($(o2).hasClass('current')) {
					css = ' class="active" ';
				}

				html += '<li' + css + '>' + linkHtml + '</li>';
			});

			html += '</ul>';
			$(o).html(html).fadeIn();
		});
	}
	initPagination();
});

