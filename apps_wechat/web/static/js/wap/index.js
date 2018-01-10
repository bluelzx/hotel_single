/**
 * Created by Administrator on 2016/9/27.
 */
$(function () {
    $(".flexslider").flexslider({
        slideshowSpeed: 4000, //展示时间间隔ms
        animationSpeed: 400, //滚动时间ms
        touch: true //是否支持触屏滑动
    });

    $("div").on('click', '.left,.right', function () {
        var id = $(this).attr('data-id');
        $("#popupDialog" + id).popup('open');
    })
});