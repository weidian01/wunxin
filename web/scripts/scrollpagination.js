/*
 **	Anderson Ferminiano
 **	contato@andersonferminiano.com -- feel free to contact me for bugs or new implementations.
 **	jQuery ScrollPagination
 **	28th/March/2011
 **	http://andersonferminiano.com/jqueryscrollpagination/
 **	You may use this script for free, but keep my credits.
 **	Thank you.
 */

(function ($) {
    $.fn.scrollPagination = function (options) {
        var opts = $.extend($.fn.scrollPagination.defaults, options);
        var target = opts.scrollTarget;
        if (target == null) {
            target = obj;
        }
        opts.scrollTarget = target;
        return this.each(function () {
            $.fn.scrollPagination.init($(this), opts);
        });
    };

    $.fn.stopScrollPagination = function () {
        return this.each(function () {
            $(this).attr('scrollPagination', 'disabled');
        });
    };

    $.fn.scrollPagination.loadContent = function (obj, opts) {
        var bottomlimit = (opts.bottomlimit.offset().top + opts.bottomlimit.height())
        //var target = opts.scrollTarget;
        var mayLoadContent = opts.scrollTarget.scrollTop() > (bottomlimit - opts.heightOffset);
        //var mayLoadContent = $(target).scrollTop() + opts.heightOffset >= $(document).height() - $(target).height();
        if (mayLoadContent && opts.loading === false && opts.over === false) {
            if (opts.beforeLoad != null) {
                opts.beforeLoad();
            }
            $(obj).children().attr('rel', 'loaded');
            opts.loading = true;
            $.ajax({
                type:opts.method,
                url:opts.contentPage,
                data:opts.contentData,
                success:function (data) {
                    //$(obj).append(data);
                    var objectsRendered = $(obj).children('[rel!=loaded]');

                    if (opts.afterLoad != null) {
                        opts.afterLoad(objectsRendered, data);
                    }
                    opts.loading = false;
                },
                dataType:opts.dataType
            });
        }
    };

    $.fn.scrollPagination.init = function (obj, opts) {
        var target = opts.scrollTarget;
        $(obj).attr('scrollPagination', 'enabled');

        $(target).scroll(function (event) {
            if ($(obj).attr('scrollPagination') == 'enabled') {
                $.fn.scrollPagination.loadContent(obj, opts);
            }
            else {
                event.stopPropagation();
            }
        });
        $.fn.scrollPagination.loadContent(obj, opts);
    };

    $.fn.scrollPagination.defaults = {
        'method':'get',
        'dataType':'*',
        'contentPage':null,
        'contentData':{},
        'beforeLoad':null,
        'afterLoad':null,
        'scrollTarget':null,
        'heightOffset':0,
        'offset':0,
        'loading':false,
        'over':false,
        'bottomlimit':null
    };
})(jQuery);