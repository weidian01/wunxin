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
                                  <td><span class="font4">￥'+fPrice(item.sell_price)+'</span></td>\
                                </tr>\
                              </table>\
                              <div class="bdimg"><img class="lazy" src="' + wx.static_url + 'images/lazy.gif" data-original="' + wx.img_url + 'product/' + idToPath(item.pid) +'icon.jpg" width="53" height="54" /></div>\
                              <div class="bdancont2" style="float:left;"><span class="font2">'+item.uname+'</span>(会员)<br/>\
                                '+item.content+'</div>\
                            </div>';
                });
                $('#hotComment').html(html).show();
                $('img.lazy').lazyload({effect:"fadeIn"});
            });
     })()



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
        html = '';
        for (k in list) {
            var item = list[k].split('|');
            html += '<div class="vhis">\
            <a class="hoverimg" href="'+wx.productURL(item[0])+'"><img class="lazy" src="' + wx.static_url + 'images/lazy.gif" data-original="' + wx.img_url + 'upload/product/' + idToPath(item[0]) + 'default.jpg" width="140" height="140" /></a>\
            <p><a href="'+wx.productURL(item[0])+'">' + item[1] + '</a></p>\
            <span class="font4">￥' + sprintf('%.2f',parseFloat(item[2])) + '</span></div>';
        }
        $('.viewhis').append(html);
        $('#viewhistory').show();
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
