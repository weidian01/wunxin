/**
 * Created with JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-10-31
 * Time: 下午6:57
 * To change this template use File | Settings | File Templates.
 */
$(function () {
    //转播图
    function initCallBack(carousel) {
        // Disable autoscrolling if the user clicks the prev or next button.
        carousel.buttonNext.bind('click', function () {
            carousel.startAuto(0);
        });

        carousel.buttonPrev.bind('click', function () {
            carousel.startAuto(0);
        });

        // Pause autoscrolling if the user moves with the cursor over the clip.
        carousel.clip.hover(function () {
            carousel.stopAuto();
        }, function () {
            carousel.startAuto();
        });
    }
    jQuery('#user_center_list').jcarousel({auto:5, scroll:1, wrap:'last', initCallback:initCallBack});


    //转播图
    function initCallBack2(carousel) {
        // Disable autoscrolling if the user clicks the prev or next button.
        carousel.buttonNext.bind('click', function () {
            carousel.startAuto(0);
        });

        carousel.buttonPrev.bind('click', function () {
            carousel.startAuto(0);
        });

        // Pause autoscrolling if the user moves with the cursor over the clip.
        carousel.clip.hover(function () {
            carousel.stopAuto();
        }, function () {
            carousel.startAuto();
        });
    }
    jQuery('#u_center_list').jcarousel({auto:5, scroll:1, wrap:'last', initCallback:initCallBack2});


    //转播图
    function initCallBack3(carousel) {
        // Disable autoscrolling if the user clicks the prev or next button.
        carousel.buttonNext.bind('click', function () {
            carousel.startAuto(0);
        });

        carousel.buttonPrev.bind('click', function () {
            carousel.startAuto(0);
        });

        // Pause autoscrolling if the user moves with the cursor over the clip.
        carousel.clip.hover(function () {
            carousel.stopAuto();
        }, function () {
            carousel.startAuto();
        });
    }
    jQuery('#order_list').jcarousel({auto:6, scroll:1, wrap:'last', initCallback:initCallBack3});
});