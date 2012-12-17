<div id="gototop"><a href="#"><i class="icon-plane"></i>TOP</a></div>
<footer>
    <p>&copy; Copyright <?=date('Y');?> 万象乾鑫科技有限公司</p>
</footer>
<script src="<?=url('static')?>bootstrap/js/jquery.js"></script>
<script src="<?=url('static')?>bootstrap/js/bootstrap.js"></script>
</body>
</html>
<script>
    $(function ($) {
        var $win = $(window)
            , $nav = $('.subnav')
            , navTop = $('.subnav').length && $('.subnav').offset().top - 40
            , isFixed = 0
            , $gototop = $('#gototop')
        processScroll()
        $win.on('scroll', processScroll)
        function processScroll() {
            var i, scrollTop = $win.scrollTop()
            if (scrollTop >= navTop && !isFixed) {
                isFixed = 1
                $nav.addClass('subnav-fixed');
                $gototop.show();
            } else if (scrollTop <= navTop && isFixed) {
                isFixed = 0
                $nav.removeClass('subnav-fixed');
                $gototop.hide();
            }
        }
    })
</script>