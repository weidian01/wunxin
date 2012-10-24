$(function ($) {

    $(".goods-cbox").hover(
        function () {
            $(this).css("border", "1px solid #ac1116");
        },
        function () {
            $(this).css("border", "1px solid #e8e8e8");
        }
    );

    browseHistoryHTML();
    $('.goodsbox img.lazy').lazyload({effect:"fadeIn"});

    (function(){
            wx.jsonp(wx.base_url + "product/ajax/hotComment", {}, function (data) {
                var html = '';
                $.each(data, function (i, item) {
                    html += '<div class="bdan2">\
                              <table width="95%" border="0" cellspacing="0" cellpadding="0">\
                                <tr>\
                                  <td><a href="'+wx.productURL(item.pid)+'">'+item.pname+'</a></td>\
                                  <td><span class="font4">￥'+wx.fPrice(item.sell_price)+'</span></td>\
                                </tr>\
                              </table>\
                              <div class="bdimg"><img class="lazy" src="' + wx.static_url + 'images/lazy.gif" data-original="' + wx.img_url + 'product/' + idToPath(item.pid) +'icon.jpg" width="50" height="50" title="'+item.pname+'"/></div>\
                              <div class="bdancont2" style="float:left;"><span class="font2">'+item.uname+'</span>(会员)<br/>\
                                '+item.content+'</div>\
                            </div>';
                });
                $('#hotComment').html(html).show();
                $('img.lazy').lazyload({effect:"fadeIn"});
            });
     })()

    /*无限下拉*/
    $(function () {
        var keyword = $('#keyword').val()
        if(! $.trim($('#goodsbox').text())) return;
        $('#goodsbox').scrollPagination({
            'dataType':'json',
            'contentPage':global.next_page, // the url you are fetching the results
            'contentData':'offset=32&callback=?', // these are the variables you can pass to the request, for example: children().size() to know which page you are
            'scrollTarget':$(window), // who gonna scroll? in this example, the full window
            'heightOffset':600, // it gonna request when scroll is 10 pixels before the page ends
            'bottomlimit': $('#goodsbox'),
            'beforeLoad':function () { // before load function, you can display a preloader div
                $('#loading').show();
                this.offset += 32;
                this.contentData = 'offset='+this.offset+'&callback=?'
            },
            'afterLoad':function (elementsLoaded, data) { // after loading content, you can use this function to animate your new elements
                $('#loading').hide();
                $(elementsLoaded).fadeInWithDelay();
                var html = '';
                var mark = this.offset;
                $.each(data, function(i, item){
                    html +='<div class="goods-cb">\
                            <div class="goods-cbox">\
                            <a href="'+wx.productURL(item.pid)+'" target="_blank"><img style="display: inline;" class="lazy'+mark+'" src="'+wx.static_url+'images/lazy.gif" data-original="'+wx.img_url+'product/'+idToPath(item.pid)+'default.jpg" alt="十字 T恤1" height="220" width="164"></a>\
                            <p>'+item.pname+'<br>\
                            <span class="font4">'+wx.fPrice(item.sell_price)+'</span></p>\
                            </div></div>';
                })

                if (!html || mark > 320) { // if more than 100 results already loaded, then stop pagination (only for testing)
                    this.over = true;
                    $('#nomoreresults').fadeIn();
                    $('#content').stopScrollPagination();
                }
                else
                {
                    $('#goodsbox').append(html);
                    $('img.lazy'+mark).lazyload({effect:"fadeIn"});
                }
            }
        });

        // code for fade in element by element
        $.fn.fadeInWithDelay = function () {
            var delay = 0;
            return this.each(function () {
                $(this).delay(delay).animate({opacity:1}, 200);
                delay += 1000;
            });
        };
    });
});

function rankbox(a,b,id) {
    var size = $('.bdan').size();
    for (var i = 1; i <= size; i++) {
        $("#"+ a + i).css({'borderRight':'1px solid #e5e5e5','borderLeft':'1px solid #e5e5e5','borderTop':'1px solid #e5e5e5'})
        document.getElementById(b + i).style.display = (i == id) ? 'block':"none";
    }
    $("#"+ a + id).css({'borderRight':'1px solid #ca0000','borderLeft':'1px solid #ca0000','borderTop':'1px solid #ca0000'})
}

function browseHistoryHTML()
{
    var str = wx.getCookie('browseHistory');
    if (str) {
        var list = str.split(';').reverse();
        var html='';
        for(k in list)
        {
            var item = list[k].split('|');
            html += '<div class="recordbox"> \
                <a href="'+wx.productURL(item[0])+'"><img class="lazy" src="'+wx.static_url+'images/lazy.gif" data-original="' + wx.img_url + 'product/'+idToPath(item[0])+'default.jpg" width="164" height="197" /></a>\
                    <p><a href="'+wx.productURL(item[0])+'">'+item[1]+'</a><br/> \
                      <span class="font19">￥'+sprintf('%.2f', parseFloat(item[2]))+'</span></p> \
                  </div>';
        }
        $('#browseHistory').append(html).show();
    }
}


$(document).ready(function () {

    $(".rankbox ul.bdan li").mouseover(function () {
        $("li", $(this).parent()).removeClass('on');
        $("li", $(this).parent()).find(".bdimg").css("display", "none");
        $("li", $(this).parent()).find(".bdprice").css("display", "none");

        $(this).addClass("on");
        $(this).find(".bdimg").css("display", "block");
        $(this).find(".bdprice").css("display", "block");
    });
    $(".ginfo-tle1").click(function () {
        $(".ginfo-tle1").css("background-position", "0px -32px");
        $(".ginfo-tle1").find("span").css({"background-position":"right -98px", "color":"#333333"});
        $(this).css("background-position", "0px 0px");
        $(this).find("span").css({"background-position":"right -66px", "color":"#ffffff"});

    });
    $(".dinfo-tle1").click(function () {
        $(".dinfo-tle1").css("background-position", "0px -32px");
        $(".dinfo-tle1").find("span").css({"background-position":"right -98px", "color":"#333333"});
        $(this).css("background-position", "0px 0px");
        $(this).find("span").css({"background-position":"right -66px", "color":"#ffffff"});

    });
});
